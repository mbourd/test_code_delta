<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    /**
     * Build the User form
     * Specifying each field it's type text|integer etc.
     * Each inputs are required
     * Adding some security such as min or max
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                "label" => "Name",
                "required" => true,
                "attr" => [
                    "minLength" => 2,
                    "maxLength" => 50
                ]
            ])
            ->add('age', IntegerType::class, [
                // "mapped" => false,
                "label" => "Age",
                "required" => true,
                "attr" => [
                    // "placeholder" => "Type the user age",
                    "min" => 0,
                    "max" => 120
                ]
            ])
            // ->add('save', SubmitType::class, [
            //     "label" => "",
            //     "attr" => [
            //         "class" => "btn btn-primary"
            //     ]
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
