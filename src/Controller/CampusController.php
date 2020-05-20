<?php

namespace App\Controller;

use App\Entity\Campus;
use App\Form\CampusType;
use App\Repository\CampusRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/campus")
 */
class CampusController extends AbstractController
{
    /**
     * @Route("/", name="campus_index", methods={"GET"})
     */
    public function index(CampusRepository $campusRepository): Response
    {
        return $this->render('campus/index.html.twig', [
            'campuses' => $campusRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="campus_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $campu = new Campus();
        $form = $this->createForm(CampusType::class, $campu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($campu);
            $entityManager->flush();

            return $this->redirectToRoute('campus_index');
        }

        return $this->render('campus/new.html.twig', [
            'campu' => $campu,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idCampus}", name="campus_show", methods={"GET"})
     */
    public function show(Campus $campu): Response
    {
        return $this->render('campus/show.html.twig', [
            'campu' => $campu,
        ]);
    }

    /**
     * @Route("/{idCampus}/edit", name="campus_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Campus $campu): Response
    {
        $form = $this->createForm(CampusType::class, $campu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('campus_index');
        }

        return $this->render('campus/edit.html.twig', [
            'campu' => $campu,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idCampus}", name="campus_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Campus $campu): Response
    {
        if ($this->isCsrfTokenValid('delete'.$campu->getIdCampus(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($campu);
            $entityManager->flush();
        }

        return $this->redirectToRoute('campus_index');
    }
}