<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
class MonController extends AbstractController
{
    /**
     * @Route("/mon", name="mon")
     */
    public function index(Request $request, EntityManagerInterface $manager): Response
    {
        $Login= $request->request->get('nom'); // a faire dans route /login qui sera envoyé avec submit
        $Pass= $request->request->get("password");

        $utilisateur = $manager ->getRepository(Utilisateurs::class)->findOneBy

        return $this->render('mon/index.html.twig', [
            'controller_name' => 'MonController','login' => $Login
        ]);
    }
    /**
     * @Route("/utilisateurs", name="utilisateurs")
     */
    public function utilisateurs(Request $request, EntityManagerInterface $manager): Response
    {

        return $this->render('mon/utilisateurs.html.twig', [
            'controller_name' => 'MonController',
        ]);
    }
}