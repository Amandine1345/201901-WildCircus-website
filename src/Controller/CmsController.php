<?php

namespace App\Controller;

use App\Entity\Cms;
use App\Entity\Performance;
use App\Entity\Performer;
use App\Form\ContactUsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

class CmsController extends AbstractController
{
    /**
     * @Route("/cms/{cms_type}", name="cms")
     * @param UploaderHelper $uploaderHelper
     * @param string $cms_type
     * @return Response
     */
    public function index(UploaderHelper $uploaderHelper, string $cms_type) : Response
    {
        $cms = new Cms();

        $cmsPage = $this->getDoctrine()->getManager()->getRepository(Cms::class)
            ->findOneBy(['cmsType' => $cms->getCmsTypeKey($cms_type)]);

        $performers = $this->getDoctrine()->getManager()->getRepository(Performer::class)
            ->findAll();

        $pathPicturePerformers = $uploaderHelper->asset($performers[0], 'pictureFile');
        $pathPicturePerformers = str_replace($performers[0]->getPicture(), '', $pathPicturePerformers);

        $performances = $this->getDoctrine()->getManager()->getRepository(Performance::class)
            ->findAll();

        $formContactUs = $this->createForm(ContactUsType::class);

        return $this->render('cms/index.html.twig', [
            'cmsPage' => $cmsPage,
            'cmsType' => $cms_type,
            'performers' => $performers,
            'pathPicturePerformers' => $pathPicturePerformers,
            'performances' => $performances,
            'contactUs' => $formContactUs->createView()
        ]);
    }
}
