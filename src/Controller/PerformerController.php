<?php

namespace App\Controller;

use App\Entity\Performer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Intl\Intl;

class PerformerController extends AbstractController
{
    /**
     * @Route("/performer/{id}", requirements={"id"="\d+"}, name="performer_show", methods={"GET"})
     * @param Request $request
     * @param Performer $performer
     * @return Response
     */
    public function show(Request $request, Performer $performer) : Response
    {
        if (!$request->isXmlHttpRequest()) {
            return $this->json("Error, only call in Ajax");
        }
        $country = Intl::getRegionBundle()->getCountryName($performer->getCountryIso());
        $performer->setCountryName($country);

        return $this->json($performer);
    }
}
