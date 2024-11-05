<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route("/", name: "homepage")]
    #[Route("/home", name: "home")]
    public function homepage(): Response
    {
        return $this->render('pages/index.html.twig');
    }

    #[Route("/about", name: "about")]
    public function about(): Response
    {
        return $this->render('pages/about.html.twig');
    }

    #[Route("/contact", name: "contact")]
    public function contact(): Response
    {
        return $this->render('pages/contact.html.twig');
    }
}
