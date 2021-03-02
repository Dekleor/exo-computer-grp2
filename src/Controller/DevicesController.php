<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DevicesController extends AbstractController
{
    /**
     * @Route("/devices", name="devices")
     */
    public function index(): Response
    {
        return $this->render('devices/index.html.twig', [
            'controller_name' => 'DevicesController',
        ]);
    }
}
