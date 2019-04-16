<?php

namespace App\Form;

use App\Entity\DateShow;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DateShowType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateTimeType::class, [
                'required' => true,
                'label' => 'Date & Hours',
                'years' => [date('Y'), date('Y')+1, date('Y')+2],
            ])
            ->add('city', TextType::class, [
                'required' => true,
                'label'=> 'France\'s city'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DateShow::class,
        ]);
    }
}
