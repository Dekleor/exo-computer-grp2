<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ComputersController extends AbstractController
{
    /**
     * @Route("/computers", name="computers")
     */
    public function index(): Response
    {
        return $this->render('computers/index.html.twig', [
            'controller_name' => 'ComputersController',
        ]);
    }
}
