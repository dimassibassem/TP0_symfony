<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JobController extends AbstractController
{
    /**
     * @Route("/job", name="job")
     */
    public function index(): Response
    {
        return $this->render('job/index.html.twig', [
            'controller_name' => 'JobController',
        ]);
    }
     /**
     * @Route("/accueil", name="accueil")
     */
    public function acceuil(): Response
    {
        return $this->render('job/accueil.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    }
}

