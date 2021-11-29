<?php

namespace App\Controller;

use App\Entity\Reservering;
use App\Form\ReserveringType;
use App\Repository\ReserveringRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/reservering")
 */
class ReserveringController extends AbstractController
{
    /**
     * @Route("/", name="reservering_index", methods={"GET"})
     */
    public function index(ReserveringRepository $reserveringRepository): Response
    {
        return $this->render('reservering/index.html.twig', [
            'reserverings' => $reserveringRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="reservering_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reservering = new Reservering();
        $form = $this->createForm(ReserveringType::class, $reservering);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reservering);
            $entityManager->flush();

            return $this->redirectToRoute('reservering_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reservering/new.html.twig', [
            'reservering' => $reservering,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="reservering_show", methods={"GET"})
     */
    public function show(Reservering $reservering): Response
    {
        return $this->render('reservering/show.html.twig', [
            'reservering' => $reservering,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="reservering_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Reservering $reservering, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReserveringType::class, $reservering);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('reservering_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reservering/edit.html.twig', [
            'reservering' => $reservering,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="reservering_delete", methods={"POST"})
     */
    public function delete(Request $request, Reservering $reservering, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservering->getId(), $request->request->get('_token'))) {
            $entityManager->remove($reservering);
            $entityManager->flush();
        }

        return $this->redirectToRoute('reservering_index', [], Response::HTTP_SEE_OTHER);
    }
}
