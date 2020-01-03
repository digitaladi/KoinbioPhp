<?php

namespace App\Form;

use App\Entity\Fiche;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{

    public  $roles  = array("admin" => "ROLE_ADMIN", "user" => "ROLE_USER", "biotor" => 'ROLE_BIOTOR');

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('firstname', TextType::class)
//            ->add('lastname',TextType::class)
                ->add('username',TextType::class)
            ->add('email', EmailType::class)
          ->add('password', PasswordType::class)
//            ->add('confirm_password', PasswordType::class)
//            ->add('phone_number', NumberType::class)
//            ->add('street_number',NumberType::class)
//            ->add('street_type', TextType::class)
//            ->add('street_name',TextType::class)
                ->add('roles', ChoiceType::class, array(
                'attr'  =>  array('class' => 'form-control',
                    'style' => 'margin:5px 0;'),
                'choices' =>
                    array
                    (
                        'ROLE_ADMIN' => array
                        (
                            'ROLE_ADMIN' => 'ROLE_ADMIN',
                        ),
                        'ROLE_USER' => array
                        (
                            'ROLE_USER' => 'ROLE_USER'
                        ),


                    )
            ,
                'multiple' => true,
                'required' => true,
            ))
            ->add('postal_code',NumberType::class)
            ->add('commune', TextType::class)
            ->add('submit', SubmitType::class)
            ->add('fiche', EntityType::class, array('class' => Fiche::class,'expanded'  => true,
                'multiple'  => true,'choice_label' => 'plant_name'
                ))
//            ->add('roles', ChoiceType::class, array('choices'=> $this->roles,
//                'expanded'=>true,
//                'mapped'=>true,
//                'label' => 'form.roles',
//                'translation_domain' => 'messages'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
