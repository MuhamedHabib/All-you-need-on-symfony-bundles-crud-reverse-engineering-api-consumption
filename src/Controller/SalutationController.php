<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SalutationController extends AbstractController
{
    /**
     * @Route("/salutation", name="salutation")
     */
    public function index(): Response
    {
        return $this->render('salutation/index.html.twig', [
            'controller_name' => 'SalutationController',
        ]);
    }
}
