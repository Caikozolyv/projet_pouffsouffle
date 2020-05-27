<?php

namespace App\Controller;

use App\Entity\SearchSortie;
use App\Entity\Sortie;
use App\Form\SearchSortieType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;




class SearchSortieController extends AbstractController
{


    /**
     * @Route("/sortie/search", name="search_sortie")
     * @param Request $request
     * @return Response
     */

    public function searchSortie(Request $request)
    {
        $searchSortie = new SearchSortie();
        $searchSortieForm= $this->createForm(SearchSortieType::class, $searchSortie);
        $searchSortieForm->handleRequest($request);



        return $this->render('sortie/search.html.twig', [
            'search_form'=> $searchSortieForm->createView()
        ]);

    }

    public function listCampus()
    {
        $sortieRepo = $this->getDoctrine()->getRepository(Sortie::class);
        $sorties = $sortieRepo->findAllCampus();

        return $this->render('sortie/search.html.twig', [
            "sorties"=>$sorties,
        ]);
    }
}
