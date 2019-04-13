<?php

namespace App\Form;

use App\Entity\Price;
use App\Entity\PriceCategory;
use App\Entity\PricePeriod;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PriceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('price', NumberType::class, [
                'required' => true,
                'attr' => [
                    'min' => 0,
                ]
            ])
            ->add('period', EntityType::class, [
                'required' => true,
                'class' => PricePeriod::class,
                'choice_label' => 'name',
                'query_builder' => function(EntityRepository $er) use ($options) {
                    return $er->createQueryBuilder('e')
                        ->where('e.id = :period')
                        ->setParameter('period', $options['period']);
                }
            ])
            ->add('category', EntityType::class, [
                'required' => true,
                'class' => PriceCategory::class,
                'choice_label' => 'name',
                'query_builder' => function(EntityRepository $er) use ($options) {
                    return $er->createQueryBuilder('e')
                        ->where('e.id = :category')
                        ->setParameter('category', $options['category']);
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Price::class,
            'period' => null,
            "category" => null,
        ]);
    }
}
