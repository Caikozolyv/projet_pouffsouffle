<?php

namespace App\Controller;

use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use App\Repository\SortieRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PropertySearchController extends AbstractController {

    /**
     * @Route("/indexsearch", name="indexsearch", methods={GET})
     * @param Request $request
     * @return Response
     */
    public function indexSortie(Request $request): Response
    {
        $search = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class, $search);
        $form->handleRequest($request);

        $sorties = $this->repository->findAll();

        return $this->render('sortie/index.html.twig', [
            'current-menu' => 'sorties',
            'sorties'   => $sorties,
            'form' => $form->createView()
        ]);
    }


}