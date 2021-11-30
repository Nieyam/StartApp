<?php

namespace App\Controller;

use App\Entity\Categorien;
use App\Form\CategorienType;
use App\Repository\CategorienRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/Categorien")
 */
class CategorienController extends AbstractController
{
    /**
     * @Route("/", name="Categorien_index", methods={"GET"})
     */
    public function index(CategorienRepository $categorienRepository): Response
    {
        return $this->render('Categorien/index.html.twig', [
            'categoriens' => $categorienRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="Categorien_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $categorien = new Categorien();
        $form = $this->createForm(CategorienType::class, $categorien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($categorien);
            $entityManager->flush();

            return $this->redirectToRoute('Categorien_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Categorien/new.html.twig', [
            'categorien' => $categorien,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="Categorien_show", methods={"GET"})
     */
    public function show(Categorien $categorien): Response
    {
        return $this->render('Categorien/show.html.twig', [
            'categorien' => $categorien,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="Categorien_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Categorien $categorien, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CategorienType::class, $categorien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('Categorien_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Categorien/edit.html.twig', [
            'categorien' => $categorien,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="Categorien_delete", methods={"POST"})
     */
    public function delete(Request $request, Categorien $categorien, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categorien->getId(), $request->request->get('_token'))) {
            $entityManager->remove($categorien);
            $entityManager->flush();
        }

        return $this->redirectToRoute('Categorien_index', [], Response::HTTP_SEE_OTHER);
    }
}
