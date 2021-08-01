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
            ->add('street',TextType::class,[
                    'required' => 'true',
                ],
            )
            ->add('number', IntegerType::class, [
                'required' => 'true',
            ])
            ->add('floor', TextType::class, [])
            ->add('postalCode', TextType::class, [
                'required' => 'true',
            ])
            ->add('region', TextType::class, [
                'required' => 'true',
            ])
            ->add('other', TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
