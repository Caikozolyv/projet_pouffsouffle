<?php

namespace App\Controller;



use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * Affiche la page d'accueil du site
     * @Route("/", name="home")
     */
    public function home()
    {
       return $this->render("default/home.html.twig");
    }
}