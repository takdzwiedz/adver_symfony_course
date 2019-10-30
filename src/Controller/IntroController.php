<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IntroController extends AbstractController
{
    /**
     * @Route("/intro", name="intro")
     */
    public function index()
    {
        return $this->render('intro/index.html.twig', [
            'controller_name' => 'IntroController',
        ]);
    }
}
