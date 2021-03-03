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
            'action' => $this->generateUrl('devices_index'),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) { // Si le formulaire est soumis + valide alors il l'enregistre
            if (empty($device->setCreatedAt)) {
                $device->setCreatedAt(new DateTime()); // sans ça, bah ça marche pas pourquoi ?
            }
            $device->setUpdatedAt(new DateTime()); // Ticket Ajouter/Modifier-> " mettre une valeur à updated_at"
            $entityManager->persist($device); //utiliser que pour un nouvel objet pas de MAJ et sert à enregistrer
            $entityManager->flush(); // met à jour, si elle n'est pas appeler pas de modif dans la BdD

            return $this->redirectToRoute('devices_index');
        }


        return $this->render('devices/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
