<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CalculationController extends Controller
{
    /**
     * @Route("/", name="calculation")
     */
    public function index()
    {
        return $this->render('calculation/index.html.twig', [
            'controller_name' => 'CalculationController',
        ]);
    }
}
