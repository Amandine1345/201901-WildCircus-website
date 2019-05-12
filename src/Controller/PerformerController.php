<?php

namespace App\Controller;

use App\Entity\Performer;
use Doctrine\Common\Annotations\AnnotationException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Intl\Intl;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;

class PerformerController extends AbstractController
{
    /**
     * @Route("/performer/{id}", requirements={"id"="\d+"}, name="performer_show", methods={"GET"})
     * @param Request $request
     * @param Performer $performer
     * @return Response
     * @throws AnnotationException
     */
    public function show(Request $request, Performer $performer): Response
    {
        if (!$request->isXmlHttpRequest()) {
            return $this->json("Error, only call in Ajax");
        }
        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizer = new ObjectNormalizer($classMetadataFactory);

        // Serialize Properties with Object Instances (e.g: DateTime)
        $callback = function (
            $innerObject,
            $outerObject,
            string $attributeName,
            string $format = null,
            array $context = []
        ) {
            return $innerObject instanceof \DateTime ? $innerObject->format(\DateTime::ISO8601) : '';
        };

        $normalizer->setCallbacks(['birthday' => $callback]);

        $serializer = new Serializer([$normalizer], [$encoders]);

        $country = Intl::getRegionBundle()->getCountryName($performer->getCountryIso());
        $performer->setCountryName($country);

        $json = $serializer->normalize($performer, 'json', ['groups' => 'performance']);

        return $this->json($json);
    }
}
