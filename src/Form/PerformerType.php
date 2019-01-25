<?php

namespace App\Form;

use App\Entity\Performer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PerformerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('biography', TextareaType::class, [
                'attr' => [
                    'rows' => 5,
                ]
            ])
            ->add('birthday', BirthdayType::class)
            ->add('pictureFile', FileType::class, [
                'data_class' => null,
                'required' => false,
                'help' => 'Format: .jpg, .jpeg, .png / Max Size: 500Ko / Width: 500px.'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Performer::class,
        ]);
    }
}
