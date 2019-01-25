<?php

namespace App\Controller;

use App\Entity\AboutUs;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AboutUsController extends AbstractController
{
    /**
     * @Route("/about_us", name="about_us")
     */
    public function index()
    {
        $aboutUs = $this->getDoctrine()->getManager()->getRepository(AboutUs::class)
            ->findOneBy([], [], 0, 1);

        return $this->render('about_us/index.html.twig', [
            'aboutUs' => $aboutUs,
        ]);
    }
}
