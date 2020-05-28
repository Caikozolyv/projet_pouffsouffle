<?php

namespace App\Controller;

use App\Entity\Campus;
use App\Entity\Lieu;
use App\Entity\Sortie;
use App\Entity\Ville;
use App\Form\LieuType;
use App\Form\SearchSortieType;
use App\Form\SortieType;
use App\Repository\LieuRepository;
use App\Repository\ParticipantRepository;
use App\Repository\SortieRepository;
use App\Repository\VilleRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
     * @Route("/selectVille", name="sortie_select_ville", methods={"GET", "POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function selectVille(Request $request, LieuRepository $lr) {
//        if($request->isXmlHttpRequest()) {
//            if($request->get('idVille')) {
                $idVille = $request->get('villeId');
                $lieux = $lr->findLieuxByVilleId($idVille);
                $tabLieux = array();
//                $i = 0;
//
                foreach ($lieux as $lieu) {
//                    $tabLieux[$i]['id'] = $lieu->getIdLieu();
//                    $tabLieux[$i]['nom'] = $lieu->getNomLieu();
//                    $i++;
                    $tabLieux[] = array(
                        "id" => $lieu->getIdLieu(),
                        "name" => $lieu->getNomLieu()
                    );
                }
                return new JsonResponse($tabLieux);
//
//                $response = new Response();
//                $data = json_encode($tabLieux);
//                $response->headers->set('Content-Type', 'application/json');
//                $response->setContent($data);
//
//                return $response;
//            }
//        } else {
//            return new Response('no ajax');
//        }
//        return new Response('no ajax');
    }

    /**
     * @Route("/new", name="sortie_new", methods={"GET","POST"})
     */
    public function new(Request $request, VilleRepository $vr, LieuRepository $lr): Response
    {
        $sortie = new Sortie();
        $lieu = new Lieu();
        $campus = new Campus();
        $ville = new Ville();

        $form = $this->createForm(SortieType::class, $sortie);
        $form->handleRequest($request);

//        if ($form->isSubmitted() && $form->isValid()) {
//
//            $sortie->setName($sortie->getName());
//            $sortie->setDateHeureDebut($sortie->getDateHeureDebut());
//            $sortie->setDateLimiteInscription($sortie->getDateLimiteInscription());
//            $sortie->setNbInscriptionMax($sortie->getNbInscriptionMax());
//            $sortie->setDuree($sortie->getDuree());
//            $sortie->setInfosSortie($sortie->getInfosSortie());
//
//            $campus->setNom($campus->getName());
//
//            $lieu->setNomLieu($lieu->getNomLieu());
//            $lieu->setRue($lieu->getNomLieu());
//            $lieu->setLatitude($lieu->getLatitude());
//            $lieu->setLongitude($lieu->getLongitude());
//
//            //Ville ne marche toujours pas, tralalalalala
//            $ville->setNomVille($ville->getNomVille());
//
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->persist($sortie);
//            $entityManager->flush();
//
//            return $this->redirectToRoute('sortie');
//
//            //La création ne marche pas :(
//
//
//
//        }

        return $this->render('sortie/new.html.twig', [

            //Je ne sais pas où le mettre car ici il ne veut pas pourquoi??
            //'sortie' => $sortieRepository->findSortie(),
//            'sortie' => $sortie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/inscire/{idSortie}", name="sortie_inscrire", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function inscire(Request $request, EntityManagerInterface $em, $idSortie, SortieRepository $sr): Response
    {
        $user = $this->getUser();
        $sortie = $sr->find($idSortie);
        //  if($sortie->getNbInscriptionMax() < sizeof($sortie->getListeParticipants())){
        $sortie->addParticipant($user);
        $em->flush();
        //}
        return $this->render('sortie/inscrisSucces.html.twig', [
            'sortie' => $sortie,
            'inscrit'=>true]);
    }

    /**
     * @Route("/desinscrire/{idSortie}", name="sortie_desinscrire", methods={"GET","POST"})
     */
    public function desinscrire(Sortie $sortie, EntityManagerInterface $em, $idSortie, SortieRepository $sr) {
        $user = $this->getUser();
        $sortie = $sr->find($idSortie);
        $sortie->removeParticipant($user);
        $em->flush();

        return $this->render('sortie/inscrisSucces.html.twig', [
            'sortie' => $sortie,
            'inscrit'=>false]);
    }

    /**
     * @Route("/mySorties", name="sortie_show_my_sorties", methods={"GET","POST"})
     */
    public function showMySorties(SortieRepository $sr, ParticipantRepository $pr)
    {
        $currentUser = $this->getUser()->getUsername();
        $user = $pr->findOneByUsername($currentUser);
        $userId = $user->getIdParticipant();
        $sorties = $sr->findAllByUser($userId);
        return $this->render('sortie/mysorties.html.twig', [
            'sorties' => $sorties
        ]);
    }

        /**
     * @Route("/{idSortie}", name="sortie_show", methods={"GET"})
     * @param Sortie $sortie
     * @return Response
     */
    public function show(Sortie $sortie, ParticipantRepository $pr, SortieRepository $sr, $idSortie): Response
    {
        dump($sortie);
        $inscrit = false;
        $currentUser = $this->getUser()->getUsername();
        $user = $pr->findOneByUsername($currentUser);
        $userId = $user->getIdParticipant();
        $userSorties = $sr->findAllByUser($userId);
        foreach ($userSorties as $s) {
            if($s->getIdSortie() == $idSortie) {
                $inscrit = true;
                break;
            }
        }
        return $this->render('sortie/show.html.twig', [
            'sortie' => $sortie,
            'inscrit' => $inscrit
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
