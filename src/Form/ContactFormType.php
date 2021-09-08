<?php

namespace App\Form;

use App\Entity\ContactForm;
use Doctrine\Common\Annotations\Annotation\Required;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'required' => 'true',
            ])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Retail customer' => "RetailCustomer",
                    'Corporate' => "Corporate"
                ],
                'required' => 'true'
                ,
                'label' => 'From a'
            ])
            ->add('phone',  IntegerType::class, [
                'attr' => [
                    'pattern' => '[0-9]{3}-[0-9]{2}-[0-9]{3}'
                ],
                'required' => 'true',
            ])
            ->add('reason', choiceType::class, [
                'choices' => formReason,
                'required' => 'true',
            ])
            ->add('message', TextareaType::class, [
                'required' => 'true',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ContactForm::class,
        ]);
    }
}

const formReason = [
    "Be attended by a professional" => 'Bussines',
    "I want to sugest a feature" => 'Feature',
    "I want to report a bug" => 'Bug',
    "Other" => 'Other'
];
