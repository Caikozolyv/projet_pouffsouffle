<?php

namespace App\Controller;

use App\Entity\Campus;
use App\Entity\Etat;
use App\Entity\FindSortie;
use App\Entity\Lieu;
use App\Entity\Participant;
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
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints\Time;

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
        $findSortie = new FindSortie();
        $form= $this->createForm(SearchSortieType::class, $findSortie);
        $form->handleRequest($request);

        $user =$this->getUser();
        $participant = new Participant($user);


        if ($form->isSubmitted()) {

            // dump($request->get('name'));
            // $form->getData();
            // die();
            $laListe = $sortieRepository->findAllBySearch($findSortie, $participant);
            return $this->render('sortie/index.html.twig',[
                'form'=>$form->createView(),
                'sorties' => $laListe,
            ]);
        }
        //   $searchSortie->setName('MacDo');
        $laListe = $sortieRepository->findAllBySearch($findSortie, $participant);

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
    public function new(Request $request): Response
    {
        $sortie = new Sortie();
        $lieu = new Lieu();
        $campus = new Campus();
        $ville = new Ville();

        //Ligne rajout Victor pour Etat
        $etatController = new EtatController();


        $form = $this->createForm(SortieType::class, $sortie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $sortie->setName($sortie->getName());
            $sortie->setDateHeureDebut($sortie->getDateHeureDebut());
            $sortie->setDateLimiteInscription($sortie->getDateLimiteInscription());
            $sortie->setNbInscriptionMax($sortie->getNbInscriptionMax());
            $sortie->setDuree($sortie->getDuree());
            $sortie->setInfosSortie($sortie->getInfosSortie());

            $campus->setNom($campus->getName());

            $lieu->setNomLieu($lieu->getNomLieu());
            $lieu->setRue($lieu->getNomLieu());
            $lieu->setLatitude($lieu->getLatitude());
            $lieu->setLongitude($lieu->getLongitude());

            //Ville ne marche toujours pas, tralalalalala
            $ville->setNomVille($ville->getNomVille());

            //Lignes ajout Victor pour Etat
            $repoEtats = $etatController->getDoctrine()->getManager()->getRepository();
            $ouverte = $repoEtats->find(2);
            $sortie->setEtat($ouverte);
            $ouverte = $repoEtats->find(2);
            $sortie->setEtat($ouverte);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sortie);
            $entityManager->flush();

            return $this->redirectToRoute('sortie');

            //La création ne marche pas :(



        }

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
        $dateDuJour = new Date();
        $inscrit = false;
        $complet = false;
        $dateLimite = false;
        $inscriptionFinale = 0;

        if($sortie->getNbInscriptionMax() > count($sortie->getListeParticipants())){
            $inscriptionFinale=+1;
        }
        else{
            $complet = true;
        }

        if($sortie->getDateLimiteInscription() > $dateDuJour){
            $inscriptionFinale=+1;
        }
        else{
            $dateLimite = true;
        }

        if($inscriptionFinale == 2){
            $sortie->addParticipant($user);
            $em->flush();
            $inscrit = true;
            return $this->render('sortie/inscrisSucces.html.twig', [
                'sortie' => $sortie,
                'inscrit'=> $inscrit]);
        }
        return $this->render('sortie/show.html.twig', [
            'sortie' => $sortie,
            'inscrit'=> $inscrit,
            'complet'=>$complet,
            'dateLimite'=>$dateLimite
        ]);

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

    /**
     */
    public function updateAllSorties()
    {
        $em = $this->getDoctrine()->getManager();

        //$etatController = new EtatController();

        $dateDuJour = new \DateTime();

        $repoSorties = $this->getDoctrine()->getManager()->getRepository(Sortie::class);
        $repoEtats = $this->getDoctrine()->getManager()->getRepository(Etat::class);

        $ouverte = $repoEtats->find(2);
        $cloturee = $repoEtats->find(3);
        $enCours = $repoEtats->find(4);
        $passee = $repoEtats->find(5);
        $annulee = $repoEtats->find(6);

        $lesSorties = $repoSorties->findAll();

        foreach ($lesSorties as $sortie){
            if($sortie instanceof Sortie)
            {
                if($sortie->getEtat() == null){
                    $sortie->setEtat($ouverte);
                }
                if($sortie->getNbInscriptionMax() > count($sortie->getListeParticipants()) &&
                    $sortie->getEtat()==$cloturee)
                {
                    $sortie->setEtat($ouverte);
                }
                if($sortie->getNbInscriptionMax() == count($sortie->getListeParticipants()) &&
                    $sortie->getEtat()==$ouverte)
                {
                    $sortie->setEtat($cloturee);
                }
                /*                if($sortie->getDateHeureDebut() > $dateDuJour &&
                                    ($sortie->getDateHeureDebut()+$laDuree)<$dateDuJour &&
                                    ($sortie->getEtat()==$ouverte || $sortie->getEtat()==$cloturee ))
                                {
                                    $sortie->setEtat($enCours);
                                }
                                if(($sortie->getDateHeureDebut()+$laDuree > $dateDuJour) &&
                                    $sortie->getEtat()==$enCours)
                                {
                                    $sortie->setEtat($passee);
                                }*/
                $em->persist($sortie);

            }
            $em->flush();
        }
    }
}
