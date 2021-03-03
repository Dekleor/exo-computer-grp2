<?php

namespace App\Controller;

use App\Form\ComputerFormType;
use Monolog\DateTimeImmutable;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Computers;

/**
 * @Route("/computers", name="computer_")
 */

class ComputersController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $computer = new Computers();

        $form = $this->createForm(ComputerFormType::class, $computer, [
            'method' => 'POST',
//            'action' => $this->generateUrl('computers')
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $computer->setUpdatedAt(new DateTime());
            $entityManager->persist($computer);
            $entityManager->flush();

            return $this->redirectToRoute('computers');
        }


        return $this->render('computers/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
