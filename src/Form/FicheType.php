<?php

namespace App\Form;

use App\Entity\CategorieFiche;
use App\Entity\Fiche;

use App\Entity\ReceptablePlante;
use App\Entity\TypePlantes;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;


class FicheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('plant_name', TextType::class,[
                'label'=> 'Nom de la plante',
            ])
//            ->add('plant_scientist_name')
//            ->add('origin')

            ->add('imageFile', VichImageType::class,[
                'required' => true ,
                'allow_delete' => false , //Permet de cacher le champ qui permet de supprimer l'image remplacé
                'download_uri' => false ,
                'download_label' => false , //cacher le lien qui permet de télécharger l'image dand edit
                'image_uri' => false, //pour cacher l'image dans à modifier dans l'edit
                'label'=> 'Image de la plante',



            ])
            ->add('taille', IntegerType::class, ['label'=> 'La taille de plante (en cm)'])
//            ->add('exposed_temperature')
//            ->add('arrosage')art
//            ->add('relative_humidity')
            ->add('emplacement', TextType::class,[
                'label'=> 'L\'emplacement de la plante',
            ])
//            ->add('descriptif')
//            ->add('saison_floraison')
//            ->add('ground')
//            ->add('servicing')
//            ->add('insolation')
//            ->add('is_semis')
//            ->add('is_medicinale',CheckboxType::class,[
//                'required' => false ,
//                'label'=> 'Cette plante est t\'elle médicinale ?',])

//            ->add('conseil')
            ->add('typePlante', EntityType::class,
                array("class"=> TypePlantes::class,
                     'choice_label' => 'name','label'=> 'Le type de plante'))
//            ->add('receptablePlante', EntityType::class, array("class" => ReceptablePlante::class, 'choice_label'=> 'name'))
            ->add('categorieFiche', EntityType::class, array("class"=> CategorieFiche::class,
                'choice_label' => 'name','label'=> 'la catégorie de plante'))
//            ->add('users', EntityType::class, array('class' => User::class, 'choice_label' => 'username', 'expanded'  => true,
//                'multiple'  => true,))
                ->add('dateBirthOrBuy', DateType::class, ['widget'=> 'choice', 'label'=> 'Date de plantation ou d\'achat'])
            ->add('whyFiche', TextareaType::class, ['label'=> 'Pourquoi l\'avez vous planter ou acheter ?'])
            ->add('bienfaits', TextareaType::class, ['label'=>'Quels sont les bienfaits tirés de cette plante'])
            ->add('Enregistrer', SubmitType::class, ['attr'=> ['class'=> 'koin_btn']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Fiche::class,
        ]);
    }
}
