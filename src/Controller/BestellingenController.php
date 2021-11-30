<?php

namespace App\Controller;

use App\Entity\Bestellingen;
use App\Form\BestellingenType;
use App\Repository\BestellingenRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/Bestellingen")
 */
class BestellingenController extends AbstractController
{
    /**
     * @Route("/", name="Bestellingen_index", methods={"GET"})
     */
    public function index(BestellingenRepository $bestellingenRepository): Response
    {
        return $this->render('Bestellingen/index.html.twig', [
            'bestellingens' => $bestellingenRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="Bestellingen_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $bestellingen = new Bestellingen();
        $form = $this->createForm(BestellingenType::class, $bestellingen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($bestellingen);
            $entityManager->flush();

            return $this->redirectToRoute('Bestellingen_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Bestellingen/new.html.twig', [
            'bestellingen' => $bestellingen,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="Bestellingen_show", methods={"GET"})
     */
    public function show(Bestellingen $bestellingen): Response
    {
        return $this->render('Bestellingen/show.html.twig', [
            'bestellingen' => $bestellingen,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="Bestellingen_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Bestellingen $bestellingen, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BestellingenType::class, $bestellingen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('Bestellingen_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Bestellingen/edit.html.twig', [
            'bestellingen' => $bestellingen,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="Bestellingen_delete", methods={"POST"})
     */
    public function delete(Request $request, Bestellingen $bestellingen, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bestellingen->getId(), $request->request->get('_token'))) {
            $entityManager->remove($bestellingen);
            $entityManager->flush();
        }

        return $this->redirectToRoute('Bestellingen_index', [], Response::HTTP_SEE_OTHER);
    }
}
