<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DirectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'street',
                TextType::class,
                [
                    'required' => 'true',
                    'attr' => [
                        'class' => 'input-text'
                    ],
                ],
            )
            ->add('number', IntegerType::class, [
                'required' => 'true',
                'attr' => [
                    'class' => 'input-text'
                ],
            ])
            ->add('floor', TextType::class, [
                'attr' => [
                    'class' => 'input-text'
                ],
            ])
            ->add('postalCode', TextType::class, [
                'required' => 'true',
                'attr' => [
                    'class' => 'input-text'
                ],
            ])
            ->add('region', TextType::class, [
                'required' => 'true',
                'attr' => [
                    'class' => 'input-text'
                ],
            ])
            ->add('other', TextType::class, [
                'attr' => [
                    'class' => 'input-text'
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
