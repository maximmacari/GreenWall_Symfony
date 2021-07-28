<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('category', TextType::class)
            ->add('price', MoneyType::class, 
            [
            /*     'required' => $options['require_price']
                , */
                'currency' => "",
                'attr' => array('min' => 0.1, 'max' => 9999)
            ])
            ->add('taxRate', ChoiceType::class, [
                'choices'  => [
                    'Normal 21%' => 21,
                    'Reduced 10%' => 10,
                    'Super Reduced 4%' => 4,
                ]
            ])
            ->add('description', TextareaType::class)
            ->add('stock', IntegerType::class, [
                'attr' => array('min' => 0, 'max' => 999),
            ])
            ->add('percentReduction', IntegerType::class, [
                'attr' => array('min' => 0, 'max' => 70),
            ])
            /*  ->add('images', FileType::class, [
                'attr' => array('multiple' => true)
            ]) */
            
            ->add('back', ButtonType::class, [
                'label' => 'Back to list',
                'attr' => [
                    "class" => "btn btn-return",
                ]
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Save',
                'attr' => [
                    "class" => "btn btn-accept",
                ]
            ])
            ->getForm();
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
            'require_price' => false,
        ]);
/* 

        // you can also define the allowed types, allowed values and
        // any other feature supported by the OptionsResolver component
        $resolver->setAllowedTypes('require_price', 'bool'); */
    }
}
