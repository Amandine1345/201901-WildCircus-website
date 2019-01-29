<?php

namespace App\Controller;

use App\Entity\Performer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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

        return $this->json($performer);
    }
}
