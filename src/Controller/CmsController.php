<?php

namespace App\Controller;

use App\Entity\Cms;
use App\Entity\DateShow;
use App\Entity\Performance;
use App\Entity\Performer;
use App\Entity\Price;
use App\Entity\PriceCategory;
use App\Entity\PricePeriod;
use App\Form\ContactUsType;
use App\Service\PricesByPeriodsAndCategories;
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
     * @param PricesByPeriodsAndCategories $pricesByPeriodsAndCategories
     * @return Response
     */
    public function index(
        UploaderHelper $uploaderHelper,
        string $cms_type,
        PricesByPeriodsAndCategories $pricesByPeriodsAndCategories
    ): Response {
        $cms = new Cms();

        $cmsPage = $this->getDoctrine()->getManager()->getRepository(Cms::class)
            ->findOneBy(['cmsType' => $cms->getCmsTypeKey($cms_type)]);

        $performers = $this->getDoctrine()->getManager()->getRepository(Performer::class)
            ->findAll();

        $performances = $this->getDoctrine()->getManager()->getRepository(Performance::class)
            ->findAll();

        $dateShows = $this->getDoctrine()->getManager()->getRepository(DateShow::class)
            ->findByDate();

        $pricePeriods = $this->getDoctrine()->getManager()->getRepository(PricePeriod::class)
            ->findBy([], ['name' => 'ASC']);

        $priceCategories = $this->getDoctrine()->getManager()->getRepository(PriceCategory::class)
            ->findBy([], ['name' => 'ASC']);

        $formContactUs = $this->createForm(ContactUsType::class);

        $pathPicturePerformers = $uploaderHelper->asset($performers[0], 'pictureFile');
        $pathPicturePerformers = str_replace($performers[0]->getPicture(), '', $pathPicturePerformers);

        // get prices per period and category
        $pricesTable = $pricesByPeriodsAndCategories->getTable($pricePeriods, $priceCategories);

        return $this->render('cms/index.html.twig', [
            'cmsPage' => $cmsPage,
            'cmsType' => $cms_type,
            'performers' => $performers,
            'pathPicturePerformers' => $pathPicturePerformers,
            'performances' => $performances,
            'dateShows' => $dateShows,
            'contactUs' => $formContactUs->createView(),
            'pricesTable' => $pricesTable,
            'pricePeriods' => $pricePeriods,
            'priceCategories' => $priceCategories
        ]);
    }
}
