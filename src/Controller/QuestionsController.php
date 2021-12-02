<?php

namespace App\Controller;

use App\Entity\Questionss;
use App\Form\QuestionssType;
use App\Repository\QuestionssRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/questions")
 */
class QuestionsController extends AbstractController
{
    /**
     * @Route("/", name="questions_index", methods={"GET"})
     */
    public function index(QuestionssRepository $questionssRepository): Response
    {
        return $this->render('questions/index.html.twig', [
            'questionsses' => $questionssRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="questions_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $questionss = new Questionss();
        $form = $this->createForm(QuestionssType::class, $questionss);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($questionss);
            $entityManager->flush();

            return $this->redirectToRoute('fin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('questions/new.html.twig', [
            'questionss' => $questionss,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="questions_show", methods={"GET"})
     */
    public function show(Questionss $questionss): Response
    {
        return $this->render('questions/show.html.twig', [
            'questionss' => $questionss,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="questions_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Questionss $questionss): Response
    {
        $form = $this->createForm(QuestionssType::class, $questionss);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('questions_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('questions/edit.html.twig', [
            'questionss' => $questionss,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="questions_delete", methods={"POST"})
     */
    public function delete(Request $request, Questionss $questionss): Response
    {
        if ($this->isCsrfTokenValid('delete'.$questionss->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($questionss);
            $entityManager->flush();
        }

        return $this->redirectToRoute('questions_index', [], Response::HTTP_SEE_OTHER);
    }
}
