<?php

namespace App\Controller;

use App\Entity\Cms;
use App\Form\CmsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminCmsController
 * @Route("/admin")
 * @package App\Controller
 */
class AdminCmsController extends AbstractController
{
    /**
     * @Route("/admin_cms/{cms_type}", name="admin_cms")
     * @param Request $request
     * @param string $cms_type
     * @return Response
     */
    public function index(Request $request, string $cms_type) : Response
    {
        $cms = new Cms();

        $cmsPage = $this->getDoctrine()->getManager()->getRepository(Cms::class)
            ->findOneBy(['cmsType' => $cms->getCmsTypeKey($cms_type)]);

        $form = $this->createForm(CmsType::class, $cmsPage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_cms', ['cms_type' => $cms_type]);
        }

        return $this->render('admin/admin_cms/index.html.twig', [
            'cmsPage' => $cmsPage,
            'form' => $form->createView()
        ]);
    }
}
