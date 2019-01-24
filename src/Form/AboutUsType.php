<?php

namespace App\Form;

use App\Entity\AboutUs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AboutUsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('shortDescription', TextareaType::class, [
                'attr' => [
                    'rows' => 5,
                    'maxlength' => '1000'
                ]
            ])
            ->add('imageHomeFile', FileType::class, [
                'data_class' => null,
                'required' => false,
                'help' => 'Format: .jpg, .jpeg, .png, .gif / Max Size: 500Ko / Width: 350px.'
            ])
            ->add('fullDescription', TextareaType::class, [
                'attr' => [
                    'class' => 'summernote',
                    'rows' => 30
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AboutUs::class,
        ]);
    }
}
