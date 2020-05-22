<?php

namespace App\Controller;

use App\Entity\Participant;
use App\Form\ParticipantType;
use App\Repository\ParticipantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/participant")
 */
class ParticipantController extends AbstractController
{

    /**
     * @Route("/", name="participant_index", methods={"GET"})
     */
    public function index(ParticipantRepository $participantRepository): Response
    {
        return $this->render('participant/index.html.twig', [
            'participants' => $participantRepository->findAll(),
        ]);
    }

    /**
     * @Route("/login", name="login")
     */
    public function login(ParticipantRepository $pr)
    {
        if ($this->getUser()) {
            $participant = $this->getUser()->getUsername();
            $participantId = $pr->findBy([$participant]);
            return $this->redirectToRoute('participant_show', [
                'participantId' => $participantId
            ]);
        }
        return $this->render("participant/login.html.twig", []);
    }
    /**
     * Symfony gere la route entièrement
     * @Route("/logout", name="logout")
     */

    public function logout()
    {
    }

    /**
     * @Route("/profile", name="participant_show", methods={"GET"})
     */
    public function show(ParticipantRepository $pr, UserInterface $user): Response
    {
        $participant = $pr->findOneByUsername($user->getUsername());
        return $this->render('participant/show.html.twig', [
            'participant' => $participant
        ]);
    }

    /**
     * @Route("/{idParticipant}/edit", name="participant_edit", methods={"GET","POST"})
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
     * @Route("/{idParticipant}", name="participant_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Participant $participant): Response
    {
        if ($this->isCsrfTokenValid('delete'.$participant->getIdParticipant(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($participant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('participant_index');
    }


}
