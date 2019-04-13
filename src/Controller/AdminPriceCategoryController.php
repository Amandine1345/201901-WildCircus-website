<?php

namespace App\Controller;

use App\Entity\PriceCategory;
use App\Form\PriceCategoryType;
use App\Repository\PriceCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/price/category")
 */
class AdminPriceCategoryController extends AbstractController
{
    /**
     * @Route("/new", name="price_category_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $priceCategory = new PriceCategory();
        $form = $this->createForm(PriceCategoryType::class, $priceCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($priceCategory);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Your changes were saved!'
            );

            return $this->redirectToRoute('price_index');
        }

        return $this->render('admin/price_category/new.html.twig', [
            'price_category' => $priceCategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="price_category_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PriceCategory $priceCategory): Response
    {
        $form = $this->createForm(PriceCategoryType::class, $priceCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('price_index');
        }

        return $this->render('admin/price_category/edit.html.twig', [
            'price_category' => $priceCategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="price_category_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PriceCategory $priceCategory): Response
    {
        if ($this->isCsrfTokenValid('delete'.$priceCategory->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($priceCategory);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Your changes were saved!'
            );
        }

        return $this->redirectToRoute('price_index');
    }
}
