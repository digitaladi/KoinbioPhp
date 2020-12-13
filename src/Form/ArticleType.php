<?php

namespace App\Form;
use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('corp')

            ->add('imageFile', VichImageType::class,[
                'required' => false ,
                'allow_delete' => false , //Permet de cacher le champ qui permet de supprimer l'image remplacé
                'download_uri' => false ,
                'download_label' => false , //cacher le lien qui permet de télécharger l'image dand edit
                'image_uri' => false, //pour cacher l'image dans à modifier dans l'edit
                'label'=> 'Image de l\'article',


            ])
            ->add('is_actif', CheckboxType::class,[
                'required' => false ,
                'label'=> 'Cet article est t\'il actif ?',
            ])
            ->add('auteur',TextType::class,[
                'label'=> 'Auteur de l\'article'
            ])
            ->add('created_at', DateType::class,[
                'label'=> 'Date de création'
            ])
            ->add('source')
//            ->add('categorieArticle')
        ->add('Enregistrer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
