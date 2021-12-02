<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FinController extends AbstractController
{
    /**
     * @Route("/fin", name="fin")
     */
    public function index(): Response
    {
        return $this->render('fin/index.html.twig', [
            'controller_name' => 'FinController',
        ]);
    }
}
