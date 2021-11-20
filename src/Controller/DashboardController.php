<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/", name="dashboard", methods="GET")
     *
     * @return Response
     */
    public function index()
    {
        return $this->render('dashboard/index.html.twig', [
           'controller_name' => 'DashboardController',
       ]);
    }
}

