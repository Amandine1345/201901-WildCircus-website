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
class AdminPriceController extends AbstractController
{
    /**
     * @Route("/", name="price_index", methods={"GET"})
     */
    public function index(PriceRepository $priceRepository): Response
    {
        $pricePeriods = $this->getDoctrine()->getManager()->getRepository(PricePeriod::class)
            ->findBy([], ['name' => 'ASC']);

        $priceCategories = $this->getDoctrine()->getManager()->getRepository(PriceCategory::class)
            ->findBy([], ['name' => 'ASC']);

        // get prices per period and category
        $pricesTable = [];
        for ($i = 0; $i < count($pricePeriods); $i++) {
            $pricesTable[$i] = [
                'period' => $pricePeriods[$i],
                'details' => []
            ];
            foreach ($priceCategories as $category) {
                $price = $priceRepository->findOneBy([
                    'period' => $pricePeriods[$i]->getId(),
                    'category' => $category->getId()
                ], []);
                array_push($pricesTable[$i]['details'], [
                    'category' => $category->getId(),
                    'price' => $price
                ]);
            }
        }

        return $this->render('/admin/price/index.html.twig', [
            'pricesTable' => $pricesTable,
            'pricePeriods' => $pricePeriods,
            'priceCategories' => $priceCategories
        ]);
    }

    /**
     * @Route("/new/{period}/{category}", name="price_new", methods={"GET","POST"})
     * @param Request $request
     * @param PricePeriod|null $period
     * @param PriceCategory|null $category
     * @return Response
     */
    public function new(Request $request, PricePeriod $period  = null, PriceCategory $category = null): Response
    {
        $price = new Price();
        $form = $this->createForm(PriceType::class, $price, [
            'period' => $period,
            'category' => $category
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($price);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Your changes were saved!'
            );

            return $this->redirectToRoute('price_index');
        }

        return $this->render('/admin/price/new.html.twig', [
            'price' => $price,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="price_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Price $price): Response
    {
        $form = $this->createForm(PriceType::class, $price, [
            'period' => $price->getPeriod(),
            'category' => $price->getCategory()
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'success',
                'Your changes were saved!'
            );

            return $this->redirectToRoute('price_index', [
                'id' => $price->getId(),
            ]);
        }

        return $this->render('/admin/price/edit.html.twig', [
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

            $this->addFlash(
                'success',
                'Your changes were saved!'
            );
        }

        return $this->redirectToRoute('price_index');
    }
}
