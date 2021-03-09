<?php

namespace App\Controller;
use App\Entity\Utilisateurs;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
class MonController extends AbstractController
{
    /**
     * @Route("/mon", name="mon")
     */
    public function index(Request $request, EntityManagerInterface $manager): Response
    {

        $Login= $request->request->get('email');
        $Pass= $request->request->get('password');

        $utilisateur = $manager ->getRepository(utilisateurs::class)->findOneBy(array('email'=> $Login));


        if ($utilisateur!= NUll){
            return $this->render('mon/login_result.html.twig', [
                'controller_name' => 'connexion réussi',
                'login' => $Login,
            ]);
        }
        else{
            return $this->render('mon/index.html.twig', [
                'controller_name' => 'echec de connexion',
            ]);
        }
        
    }
    /**
     * @Route("/creation", name="creation")
     */
    public function utilisateurs(Request $request, EntityManagerInterface $manager): Response
    {

        return $this->render('mon/utilisateurs.html.twig', [
            'controller_name' => 'MonController',
        ]);
    }
     /**
     * @Route("/login", name="login")
     */
    public function login(Request $request, EntityManagerInterface $manager): Response
    {
        

            return $this->render('mon/login_result.html.twig', [
                'controller_name' => 'MonController',
            ]);
                
            
        
        
    }
    /**
     * @Route("/cUser", name="cUser")
     */
    public function creation(Request $request, EntityManagerInterface $manager): Response
    {
        $recupNom=$request->request->get('nom');
        $recupPrenom=$request->request->get('prenom');
        $recupEmail=$request->request->get('email2');
        $recupPassword=$request->request->get('password');
        
        $User = new Utilisateurs();
		$User->setNom($recupNom);
		$User->setPrenom($recupPrenom);
        $User->setEmail($recupEmail);
        $User->setPassword($recupPassword);
        $manager->persist($User);
		$manager->flush();

            
        return $this->redirectToRoute('listeUser');
                
            
        
        
    }
    /**
     * @Route("/listeUser", name="listeUser")
     */
    public function liste(Request $request, EntityManagerInterface $manager): Response
    {
            $listUser=$manager->getRepository(Utilisateurs::class)->findAll();

            return $this->render('mon/listeUser.html.twig', [
                'listUser' => $listUser
            ]);
                
            
        
        
    }

}