<?php

namespace App\Controller;

use App\Entity\Lieu;
use App\Entity\Sortie;
use App\Entity\Ville;
use App\Form\LieuType;
use App\Form\SortieType;
use App\Form\VilleType;
use App\Repository\ParticipantRepository;
use App\Repository\SortieRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sortie")
 */
class SortieController extends AbstractController
{
    /**
     * @Route("/", name="sortie_index", methods={"GET"})
     * @param SortieRepository $sortieRepository
     * @param Request $request
     * @return Response
     */
    public function index(SortieRepository $sortieRepository, Request $request): Response
    {
        $searchSortie = new Sortie();
        $form= $this->createForm(SearchSortieType::class, $searchSortie);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {


            return $this->redirectToRoute('sortie_index',[
            //'sorties' => $sortieRepository->notre requete sql(),
            ]);
        }

        $laListe = $sortieRepository->findAll();

        return $this->render('sortie/index.html.twig', [
            'form'=> $form->createView(),
            'sorties' => $laListe,
        ]);
    }

    /**
     * @Route("/new", name="sortie_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $sortie = new Sortie();
        $lieu = new Lieu();
        #$ville = new Ville();

        #$formVille = $this->createForm(VilleType::class, $ville);
        #$formVille->handleRequest($request);

        $formLieu = $this->createForm(LieuType::class, $lieu);
        $formLieu->handleRequest($request);

        $form = $this->createForm(SortieType::class, $sortie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            #$sortie->setName();
            #$sortie->setDateHeureDebut();
            #$sortie->setDateLimiteInscription();
            #$sortie->setNbInscriptionMax();
            #$sortie->setDuree();
            #$sortie->setInfosSortie();

            #$sortie->setCampus();
            #$sortie->setLieu();
            #$lieu->setLatitude();
            #$lieu->setLongitude();




            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sortie);
            $entityManager->flush();

            return $this->redirectToRoute('sortie');
        }

        return $this->render('sortie/new.html.twig', [
            'sortie' => $sortie,
            'form' => $form->createView(),
            'formLieu' =>$formLieu->createView(),
            #'formVille' =>$formVille
        ]);
    }

    /**
     * @Route("/{idSortie}", name="sortie_show", methods={"GET"})
     * @param Sortie $sortie
     * @return Response
     */
    public function show(Sortie $sortie): Response
    {
        return $this->render('sortie/show.html.twig', [
            'sortie' => $sortie,
        ]);
    }

    /**
     * @Route("/{idSortie}/edit", name="sortie_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Sortie $sortie
     * @return Response
     */
    public function edit(Request $request, Sortie $sortie): Response
    {
        $form = $this->createForm(SortieType::class, $sortie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sortie_index');
        }

        return $this->render('sortie/edit.html.twig', [
            'sortie' => $sortie,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/inscire/{idSortie}", name="sortie_inscrire", methods={"GET","POST"})
     * @param Request $request
     * @param Sortie $sortie
     * @return Response
     */
    public function inscire(Request $request, Sortie $sortie): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $this->getUser();
      //  if($sortie->getNbInscriptionMax() < sizeof($sortie->getListeParticipants())){
            $sortie->addParticipant($user);
            $entityManager->flush();
            //}
        return $this->render('sortie/inscrisSucces.html.twig', [
            'sortie' => $sortie,
            'inscrit'=>true]);
    }

    /**
     * @Route("/desinscrire/{idSortie}", name="sortie_desinscrire", methods={"GET","POST"})
     */
    public function desinscrire(Sortie $sortie) {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $sortie->removeParticipant($user);
        $entityManager->flush();

        return $this->render('sortie/inscrisSucces.html.twig', [
            'sortie' => $sortie,
            'inscrit'=>false]);
    }

    /**
     * @Route("/sorties/mySorties", name="sortie_show_my_sorties", methods={"GET","POST"})
     */
    public function showMySorties(SortieRepository $sr, ParticipantRepository $pr) {
        $currentUser = $this->getUser()->getUsername();
        $user = $pr->findOneByUsername($currentUser);
        $userId = $user->getIdParticipant();
        $sorties = $sr->findAllByUser($userId);
        return $this->render('sortie/mysorties.html.twig', [
           'sorties' => $sorties
        ]);

    }


    /**
     * @Route("/{idSortie}", name="sortie_delete", methods={"DELETE"})
     * @param Request $request
     * @param Sortie $sortie
     * @return Response
     */
    public function delete(Request $request, Sortie $sortie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sortie->getIdSortie(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sortie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sortie_index');
    }
}
