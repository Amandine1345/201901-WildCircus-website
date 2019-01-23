<?php

namespace App\Controller;

use App\Entity\AboutUs;
use App\Form\AboutUsType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AboutUsController
 * @Route("/admin")
 * @package App\Controller
 */

class AboutUsController extends AbstractController
{
    /**
     * @Route("/about_us", name="about_us")
     */
    public function index(Request $request): Response
    {
        $aboutUs = $this->getDoctrine()->getManager()->getRepository(AboutUs::class)
            ->findOneBy([],[],0,1);

        $form = $this->createForm(AboutUsType::class, $aboutUs);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('about_us');
        }

        return $this->render('about_us/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
