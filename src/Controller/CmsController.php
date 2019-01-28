<?php

namespace App\Controller;

use App\Entity\Cms;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CmsController extends AbstractController
{
    /**
     * @Route("/cms/{cms_type}", name="cms")
     */
    public function index(string $cms_type) : Response
    {
        $cms = new Cms();

        $cmsPage = $this->getDoctrine()->getManager()->getRepository(Cms::class)
            ->findOneBy(['cmsType' => $cms->getCmsTypeKey($cms_type)]);

        return $this->render('cms/index.html.twig', [
            'cmsPage' => $cmsPage,
        ]);
    }
}
