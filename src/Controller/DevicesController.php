<?php

namespace App\Controller;

use App\Entity\Devices;
use App\Form\DeviceFormType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/devices", name="devices_")
 */

class DevicesController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(EntityManagerInterface $entityManager, Request $request): Response
    {
        $device = new Devices();

        $form = $this->createForm(DeviceFormType::class, $device, [
            'method' => 'POST',
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $device->setUpdatedAt(new DateTime());
            $entityManager->persist($device);
            $entityManager->flush();

            return $this->redirectToRoute('device_index');
        }

        return $this->render('devices/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
