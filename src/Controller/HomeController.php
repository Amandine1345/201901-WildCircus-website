<?php

namespace App\Controller;

use App\Entity\AboutUs;
use App\Entity\Performer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $aboutUs = $this->getDoctrine()->getManager()->getRepository(AboutUs::class)
            ->findOneBy([], [], 0, 1);

        $performers = $this->getDoctrine()->getManager()->getRepository(Performer::class)
            ->findAll();

        shuffle($performers);
        $performers = array_slice($performers, 0, 4);

        return $this->render('home/index.html.twig', [
            'aboutUs' => $aboutUs,
            'performers' => $performers
        ]);
    }
}
