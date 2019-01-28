<?php

namespace App\Controller;

use App\Entity\Cms;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $cms = new Cms();

        $aboutUs = $this->getDoctrine()->getManager()->getRepository(Cms::class)
            ->findOneBy(['cmsType' => $cms->getCmsTypeKey('aboutus')]);

        return $this->render('home/index.html.twig', [
            'aboutUs' => $aboutUs
        ]);
    }
}
