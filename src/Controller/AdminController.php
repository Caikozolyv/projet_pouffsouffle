<?php

namespace App\Controller;

use App\Entity\Campus;
use App\Entity\Participant;
use App\Form\CampusType;
use App\Form\ParticipantType;
use App\Repository\CampusRepository;
use App\Repository\ParticipantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/new", name="participant_new", methods={"GET","POST"})
     */
    public function new(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $participant = new Participant();
        $form = $this->createForm(ParticipantType::class, $participant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hashed = $encoder->encodePassword($participant, $participant->getPassword());
            $participant->setPassword($hashed);
            $participant->setUsername($participant->getMail());
            $participant->setAdministrateur(false);
            $participant->setActif(true);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($participant);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('Admin/new.html.twig', [
            'participant' => $participant,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{idParticipant}/edit", name="participant_edit_admin", methods={"GET","POST"})
     */
    public function edit(Request $request, Participant $participant): Response
    {
        $form = $this->createForm(ParticipantType::class, $participant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('participant_index');
        }

        return $this->render('participant/edit.html.twig', [
            'participant' => $participant,
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/nav", name="nav_admin")
     */
    public function navAdmin()
    {
        return $this->render('Admin\homeAdmin.html.twig', []);
    }

    /**
     * @Route("/liste", name="admin_listing")
     */
    public function listeUtilisateurs(ParticipantRepository $participantRepository): Response
    {
        return $this->render('Admin/listeUtilisateurs.html.twig', [
            'participants' => $participantRepository->findAll(),
        ]);
    }
    /**
     * @Route("/{idParticipant}", name="participant_show_admin", methods={"GET"})
     */
    public function show(Participant $participant): Response
    {
        return $this->render('Admin/showUser.html.twig', [
            'participant' => $participant,
        ]);
    }


}
