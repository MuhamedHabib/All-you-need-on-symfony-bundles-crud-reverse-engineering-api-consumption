<?php

namespace App\Controller;

use App\Entity\Formulaire;
use App\Form\FormulaireType;
use App\Repository\FormulaireRepository;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/form")
 */
class FormController extends AbstractController
{
    /**
     * @Route("/", name="form_index")
     */
    public function index(FormulaireRepository $formulaireRepository)
    {
        $em = $this->getDoctrine()->getManager();
        $formulaire = $em->getRepository(Formulaire::class)->findAll();


        //////////////////////////
        ///
        ///

        $a=$formulaireRepository->filter("Homme");
        $i=0;
        foreach ($a as $row){
            $i++;
        }
        $b=$formulaireRepository->filter("Femme");
        $j=0;
        foreach ($b as $row){
            $j++;
        }


        $pieChart = new PieChart();
        $pieChart->getData()->setArrayToDataTable(
            [
                ['Sexe', 'Son type'],
                ['Homme', $i],
                ['Femme', $j]
            ]
        );
        $pieChart->getOptions()->setPieSliceText('label');
        $pieChart->getOptions()->setTitle('un aperçu du type de notre contenu');
        $pieChart->getOptions()->setPieStartAngle(100);
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getLegend()->setPosition('none');


        /// /////////////////////
        ///
        ///

        return $this->render('form/index.html.twig', [
            'formulaires' => $formulaire,
            'piechart' => $pieChart,
        ]);
    }












    /**
     * @Route("/new", name="form_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $formulaire = new Formulaire();
        $form = $this->createForm(FormulaireType::class, $formulaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($formulaire);
            $entityManager->flush();

            return $this->redirectToRoute('salutation', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('form/new.html.twig', [
            'formulaire' => $formulaire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="form_show", methods={"GET"})
     */
    public function show(Formulaire $formulaire): Response
    {
        return $this->render('form/show.html.twig', [
            'formulaire' => $formulaire,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="form_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Formulaire $formulaire): Response
    {
        $form = $this->createForm(FormulaireType::class, $formulaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('form_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('form/edit.html.twig', [
            'formulaire' => $formulaire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="form_delete", methods={"POST"})
     */
    public function delete(Request $request, Formulaire $formulaire): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formulaire->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($formulaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('form_index', [], Response::HTTP_SEE_OTHER);
    }
}
