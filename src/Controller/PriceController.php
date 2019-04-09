<?php

namespace App\Controller;

use App\Entity\Price;
use App\Entity\PriceCategory;
use App\Entity\PricePeriod;
use App\Form\PriceType;
use App\Repository\PriceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/price")
 */
class PriceController extends AbstractController
{
    /**
     * @Route("/", name="price_index", methods={"GET"})
     */
    public function index(PriceRepository $priceRepository): Response
    {
        $pricePeriods = $this->getDoctrine()->getManager()->getRepository(PricePeriod::class)
            ->findBy([],['name' => 'ASC']);

        $priceCategories = $this->getDoctrine()->getManager()->getRepository(PriceCategory::class)
            ->findBy([],['name' => 'ASC']);

        return $this->render('/admin/price/index.html.twig', [
            'prices' => $priceRepository->findAll(),
            'pricePeriods' => $pricePeriods,
            'priceCategories' => $priceCategories
        ]);
    }

    /**
     * @Route("/new", name="price_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $price = new Price();
        $form = $this->createForm(PriceType::class, $price);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($price);
            $entityManager->flush();

            return $this->redirectToRoute('price_index');
        }

        return $this->render('price/new.html.twig', [
            'price' => $price,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="price_show", methods={"GET"})
     */
    public function show(Price $price): Response
    {
        return $this->render('price/show.html.twig', [
            'price' => $price,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="price_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Price $price): Response
    {
        $form = $this->createForm(PriceType::class, $price);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('price_index', [
                'id' => $price->getId(),
            ]);
        }

        return $this->render('price/edit.html.twig', [
            'price' => $price,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="price_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Price $price): Response
    {
        if ($this->isCsrfTokenValid('delete'.$price->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($price);
            $entityManager->flush();
        }

        return $this->redirectToRoute('price_index');
    }
}