<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Job;
use App\Repository\JobRepository;
use App\Repository\ImageRepository;
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

    /**
     * @Route("/voir/{id}", name="voir"),requirements={"id"=>"\d+"})
     */
    public function voir($id)
    {
        $Repository = $this->getDoctrine()->getManager()->getRepository(Job::class);
        $job = $this->getDoctrine()
            ->getRepository(Job::class)
            ->find($id);
        return $this->render("job/voir.html.twig", ['job' => $job]);
    }

    public function menu(): Response
    {
        $mymenu = array(
            ['route' => 'job', 'intitule' => 'Accueil'],
            ['route' => 'ajouter', 'intitule' => 'Ajouter un job'],
            ['route' => 'list', 'intitule' => 'Afficher tous les jobs']
        );
        return $this->render('job/menu.html.twig', ['mymenu' => $mymenu]);
    }

    public function sidebar(): Response
    {
        $listjobs = array(
            ['id' => 1, 'job' => 'Developeur web'],
            ['id' => 2, 'job' => 'Responsable markitig'],
            ['id' => 3, 'job' => 'Team Leader']
        );
        return $this->render('job/sidebar.html.twig', ['listjobs' => $listjobs]);
    }

    /**
     * @Route("/ajouter", name="ajouter")
     */
    public function ajouter()
    {
        $job = new Job();

        // insertion image dans la base de donnees
        $image = new Image();

        $image->setUrl('https://consultant-webdesigner.fr/wp-content/uploads/2016/12/Logo-Symfony2-e1478873913213.png');
        $image->setAlt('symfony');

        $em = $this->getDoctrine()->getManager();
        $em->persist($image); // faire une copie sur les donnes de la var $image
        $em->flush();

        $job->setTitle('Developpeur symfony');
        $job->setCompany('Epi');
        $job->setDescription('Nous cherchons un Developpeur symfony');
        $job->setIsActivated(1);
        $job->setExpiredAt(new \DateTimeImmutable());
        $job->setEmail('epi@episousse.com.tn');
        $job->setTelephone('+216 36403215');
        $job->setImage($image);

        $em = $this->getDoctrine()->getManager();
        $em->persist($job);
        $em->flush();

        return $this->render('job/ajouter.html.twig');


    }

    /**
     * @Route("/listjobs", name="listjobs")
     */

    public function listjobs()
    {
        $jobs = $this->getDoctrine()
            ->getRepository(Job::class)
            ->findAll();


        return $this->render(
            'job/listjobs.html.twig',
            array('jobs' => $jobs)
        );
    }
}

