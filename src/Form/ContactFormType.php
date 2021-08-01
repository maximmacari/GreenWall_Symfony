<?php

namespace App\Form;

use App\Entity\ContactForm;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
                    clientType
                ],
                'required' => 'true',
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
            ])
            ->add('direction', DirectionType::class)
            ->add('Back', ButtonType::class, [
                'label' => 'Back to list',
                'attr' => [
                    "class" => "btn btn-return",
                ]
            ])
            ->add('Send', SubmitType::class, [
                'label' => 'Save',
                'attr' => [
                    "class" => "btn btn-accept",
                ]
            ])
            
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ContactForm::class,
        ]);
    }
}


const clientType = [
    'Company' => "COMPANY",
    'Retail customer' => "RETAIL_CUSTOMER"
];

const formReason = [
    "I want to sugest a feature" => 'Feature',
    "I want to report a bug" => 'Bug',
    "Be attended by a professional" => 'Bussines',
    "Other" => 'Other'
];
