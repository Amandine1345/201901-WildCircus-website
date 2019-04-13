<?php

namespace App\Controller;

use App\Entity\PricePeriod;
use App\Form\PricePeriodType;
use App\Repository\PricePeriodRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/price/period")
 */
class AdminPricePeriodController extends AbstractController
{
    /**
     * @Route("/new", name="price_period_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $pricePeriod = new PricePeriod();
        $form = $this->createForm(PricePeriodType::class, $pricePeriod);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pricePeriod);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Your changes were saved!'
            );

            return $this->redirectToRoute('price_index');
        }

        return $this->render('/admin/price_period/new.html.twig', [
            'price_period' => $pricePeriod,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="price_period_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PricePeriod $pricePeriod): Response
    {
        $form = $this->createForm(PricePeriodType::class, $pricePeriod);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'success',
                'Your changes were saved!'
            );

            return $this->redirectToRoute('price_index');
        }

        return $this->render('/admin/price_period/edit.html.twig', [
            'price_period' => $pricePeriod,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="price_period_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PricePeriod $pricePeriod): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pricePeriod->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pricePeriod);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Your changes were saved!'
            );
        }

        return $this->redirectToRoute('price_index');
    }
}
