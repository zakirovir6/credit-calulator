<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CalculationController extends Controller
{
    /**
     * @Route("/", name="calculation")
     */
    public function index()
    {
        return $this->render('calculation/index.html.twig', [
            'calculation_api_url' => $this->generateUrl('calculation_api'),
        ]);
    }
}
