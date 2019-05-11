<?php

namespace App\Controller;

use App\Entity\DateShow;
use App\Form\DateShowType;
use App\Repository\DateShowRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/date/show")
 */
class AdminDateShowController extends AbstractController
{
    /**
     * @Route("/", name="date_show_index", methods={"GET"})
     */
    public function index(DateShowRepository $dateShowRepository): Response
    {
        return $this->render('admin/date_show/index.html.twig', [
            'date_shows' => $dateShowRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="date_show_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $dateShow = new DateShow();
        $form = $this->createForm(DateShowType::class, $dateShow);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($dateShow);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Your changes were saved!'
            );

            return $this->redirectToRoute('date_show_index');
        }

        return $this->render('admin/date_show/new.html.twig', [
            'date_show' => $dateShow,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="date_show_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, DateShow $dateShow): Response
    {
        $form = $this->createForm(DateShowType::class, $dateShow);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'success',
                'Your changes were saved!'
            );

            return $this->redirectToRoute('date_show_index', [
                'id' => $dateShow->getId(),
            ]);
        }

        return $this->render('admin/date_show/edit.html.twig', [
            'date_show' => $dateShow,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="date_show_delete", methods={"DELETE"})
     */
    public function delete(Request $request, DateShow $dateShow): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dateShow->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($dateShow);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Your changes were saved!'
            );
        }

        return $this->redirectToRoute('admin/date_show_index');
    }
}
