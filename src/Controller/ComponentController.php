<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Component;
use App\Form\FormComponentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class ComponentController extends AbstractController
{
    /**
    * @Route("/new", name="new")
    */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $component = new Component();

        $form = $this->createForm(FormComponentType::class, $component);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($component);
            $entityManager->flush();

            return $this->redirectToRoute('component_index');
        }

        return $this->render('component/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
