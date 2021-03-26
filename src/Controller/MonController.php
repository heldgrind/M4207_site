<?php

namespace App\Controller;
use App\Entity\Utilisateurs;
use App\Entity\Acces;
use App\Entity\Authorisation;
use App\Entity\Documents;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
class MonController extends AbstractController
{
    /**
     * @Route("/mon", name="mon")
     */
    public function index(Request $request, EntityManagerInterface $manager,SessionInterface $session): Response
    {
        $vs=$session->get('userid');

            if($vs == 0){
                return $this->render('mon/index.html.twig', [
                    'controller_name' => 'page de Login',
                ]);
            }
            else{
                $utilisateur = $manager ->getRepository(Utilisateurs::class)->findOneBy(array('id' => $vs));
                return $this->render('mon/login_result.html.twig', [
                    'controller_name' => 'MonController',
                    'utilisateur' => $utilisateur
    
                ]);
            }
        
        
    }
    /**
     * @Route("/creation", name="creation")
     */
    public function utilisateurs(Request $request, EntityManagerInterface $manager,SessionInterface $session): Response
    {

        return $this->render('mon/utilisateurs.html.twig', [
            'controller_name' => 'MonController',
        ]);
    }
     /**
     * @Route("/login", name="/login")
     */
    public function login(Request $request, EntityManagerInterface $manager,SessionInterface $session): Response
    {
        $Login= $request->request->get('email');
        $Pass= $request->request->get('password');
        $utilisateur = $manager ->getRepository(Utilisateurs::class)->findOneBy(array('email' => $Login));
        $Pass2=$utilisateur->getPassword();
        $Verif=password_verify($Pass,$Pass2);

        if($Verif == TRUE){
            $val =$utilisateur->getid();
            $session->set('userid',$val);
            return $this->render('mon/login_result.html.twig', [
                'controller_name' => 'MonController',
                'utilisateur' => $utilisateur

            ]);
        }
        else{
            $session->set('userid',0);
            return $this->redirectToRoute('mon');
            
        }
    }

    /**
     * @Route("/cUser", name="cUser")
     */
    public function creation(Request $request, EntityManagerInterface $manager,SessionInterface $session): Response
    {
        $recupNom=$request->request->get('nom');
        $recupPrenom=$request->request->get('prenom');
        $recupEmail=$request->request->get('email2');
        $recupPassword=$request->request->get('password');
        $PassCrypt=password_hash($recupPassword,PASSWORD_DEFAULT);
        
        $User = new Utilisateurs();
		$User->setNom($recupNom);
		$User->setPrenom($recupPrenom);
        $User->setEmail($recupEmail);
        $User->setPassword($PassCrypt);
        $manager->persist($User);
		$manager->flush();

            
        return $this->redirectToRoute('listeUser');   
    }
    /**
     * @Route("/listeUser", name="listeUser")
     */
    public function liste(Request $request, EntityManagerInterface $manager,SessionInterface $session): Response
    {
            $userid=$session->get('userid');
            if ($userid>0){
                $listUser=$manager->getRepository(Utilisateurs::class)->findAll();

            return $this->render('mon/listeUser.html.twig', [
                'listUser' => $listUser
            ]);
            }
            else{
                return new Response("erreur de connexion vous n'êtes pas connecté");
            }
            
                
            
        
        
    }
    
    /**
     * @Route("/deconnexion", name="deconnexion")
     */
    public function deconnexion(Request $request, EntityManagerInterface $manager,SessionInterface $session): Response
    {
            $session->clear();
            return $this->redirectToRoute('mon');  
    }
    /**
     * @Route("/fichier", name="fichier")
     */
    public function fichier(Request $request, EntityManagerInterface $manager,SessionInterface $session): Response
    {
        return $this->render('mon/formFichier.html.twig', [
        ]);
    }
    /**
     * @Route("/ajoutfichier", name="ajoutfichier")
     */
    public function ajoutfichier(Request $request, EntityManagerInterface $manager,SessionInterface $session): Response
    {
        $chemin='C:\xampp\htdocs\M4207_site\public';
        $nom=$_FILES['fichier']['name'];
        $nomtmp=$_FILES['fichier']['tmp_name'];
        $dest=$chemin.'\\'.basename($_FILES['fichier']['name']);
        $resultat=move_uploaded_file($_FILES['fichier']['tmp_name'],$dest);

        //création document
        $Doc = new Documents();
		$Doc->setChemin($dest);
        $date = new \DateTime('NOW');
        $Doc->setDate($date);
        $Doc->setActif(1);

        $manager->persist($Doc);
		$manager->flush();
        
        
        //mise en place auth
       /*
        $Auth= new Authorisation();
        $Auth->setLecture(1);
        $Auth->setEcriture(1);
        $manager->persist($Auth);
        $manager->flush();
        */
        return $this->redirectToRoute('listFichier');
    }
    /**
     * @Route("/listFichier", name="listFichier")
     */
    public function listeFichier(Request $request, EntityManagerInterface $manager,SessionInterface $session): Response
    {
            $userid=$session->get('userid');
            if ($userid>0){
                $listFichier=$manager->getRepository(Documents::class)->findAll();

            return $this->render('mon/listFichier.html.twig', [
                'listFichier' => $listFichier
            ]);
            }
            else{
                return new Response("erreur de connexion vous n'êtes pas connecté");
            }
            
                
            
        
        
    }

}
