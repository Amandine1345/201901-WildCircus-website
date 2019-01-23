<?php

namespace App\Controller;

use App\Entity\AboutUs;
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
            ->findOneBy([],[],0,1);

        return $this->render('home/index.html.twig', [
            'aboutUs' => $aboutUs
        ]);
    }
}
