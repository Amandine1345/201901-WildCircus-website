<?php

namespace App\Controller;

use App\Entity\Performer;
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
