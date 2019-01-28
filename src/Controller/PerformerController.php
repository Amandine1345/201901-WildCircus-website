<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PerformerController extends AbstractController
{
    /**
     * @Route("/performer", name="performer")
     */
    public function index()
    {
        return $this->render('performer/index.html.twig', [
            'controller_name' => 'PerformerController',
        ]);
    }
}
