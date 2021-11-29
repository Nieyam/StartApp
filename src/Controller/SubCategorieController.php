<?php

namespace App\Controller;

use App\Entity\SubCategorie;
use App\Form\SubCategorieType;
use App\Repository\SubCategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sub/categorie")
 */
class SubCategorieController extends AbstractController
{
    /**
     * @Route("/", name="sub_categorie_index", methods={"GET"})
     */
    public function index(SubCategorieRepository $subCategorieRepository): Response
    {
        return $this->render('sub_categorie/index.html.twig', [
            'sub_categories' => $subCategorieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="sub_categorie_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $subCategorie = new SubCategorie();
        $form = $this->createForm(SubCategorieType::class, $subCategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($subCategorie);
            $entityManager->flush();

            return $this->redirectToRoute('sub_categorie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sub_categorie/new.html.twig', [
            'sub_categorie' => $subCategorie,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="sub_categorie_show", methods={"GET"})
     */
    public function show(SubCategorie $subCategorie): Response
    {
        return $this->render('sub_categorie/show.html.twig', [
            'sub_categorie' => $subCategorie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="sub_categorie_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, SubCategorie $subCategorie, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SubCategorieType::class, $subCategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('sub_categorie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sub_categorie/edit.html.twig', [
            'sub_categorie' => $subCategorie,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="sub_categorie_delete", methods={"POST"})
     */
    public function delete(Request $request, SubCategorie $subCategorie, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$subCategorie->getId(), $request->request->get('_token'))) {
            $entityManager->remove($subCategorie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sub_categorie_index', [], Response::HTTP_SEE_OTHER);
    }
}
