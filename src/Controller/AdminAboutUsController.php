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

class AdminAboutUsController extends AbstractController
{
    /**
     * @Route("/about_us_edit", name="about_us_edit")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $aboutUs = $this->getDoctrine()->getManager()->getRepository(AboutUs::class)
            ->findOneBy([], [], 0, 1);

        $form = $this->createForm(AboutUsType::class, $aboutUs);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('about_us_edit');
        }

        return $this->render('admin/about_us/index.html.twig', [
            'aboutUs' => $aboutUs,
            'form' => $form->createView()
        ]);
    }
}
