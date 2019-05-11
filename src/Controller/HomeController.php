<?php

namespace App\Controller;

use App\Entity\DateShow;
use App\Entity\Performance;
use App\Entity\Performer;
use App\Entity\Cms;
use App\Form\ContactUsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param UploaderHelper $uploaderHelper
     * @return Response
     */
    public function index(UploaderHelper $uploaderHelper) : Response
    {
        $cms = new Cms();

        $aboutUs = $this->getDoctrine()->getManager()->getRepository(Cms::class)
            ->findOneBy(['cmsType' => $cms->getCmsTypeKey('aboutus')]);

        $performers = $this->getDoctrine()->getManager()->getRepository(Performer::class)
            ->findAll();

        $performances = $this->getDoctrine()->getManager()->getRepository(Performance::class)
            ->findBy([], ['name' => 'ASC']);

        $dateShows = $this->getDoctrine()->getManager()->getRepository(DateShow::class)
            ->findByDate(5);

        shuffle($performers);
        $performers = array_slice($performers, 0, 4);

        $pathPicturePerformers = $uploaderHelper->asset($performers[0], 'pictureFile');
        $pathPicturePerformers = str_replace($performers[0]->getPicture(), '', $pathPicturePerformers);

        $formContactUs = $this->createForm(ContactUsType::class);

        return $this->render('home/index.html.twig', [
            'aboutUs' => $aboutUs,
            'performers' => $performers,
            'pathPicturePerformers' => $pathPicturePerformers,
            'performances' => $performances,
            'dateShows' => $dateShows,
            'contactUs' => $formContactUs->createView()
        ]);
    }
}
