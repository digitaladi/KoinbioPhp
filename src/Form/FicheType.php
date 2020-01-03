<?php

namespace App\Form;

use App\Entity\Fiche;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FicheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('plant_name', TextType::class)
            ->add('plant_scientist_name')
            ->add('origin')
            ->add('type')
            ->add('image')
            ->add('exposed_temperature')
            ->add('arrosage')
            ->add('relative_humidity')
            ->add('emplacement')
            ->add('descriptif')
            ->add('saison_floraison')
            ->add('ground')
            ->add('servicing')
            ->add('insolation')
            ->add('is_semis')
            ->add('is_medicinale')
            ->add('create_at')
            ->add('conseil')
            ->add('typePlante')
            ->add('receptablePlante')
            ->add('categorieFiche')
//            ->add('users', EntityType::class, array('class' => User::class, 'choice_label' => 'username', 'expanded'  => true,
//                'multiple'  => true,))
            ->add('Envoyer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Fiche::class,
        ]);
    }
}
