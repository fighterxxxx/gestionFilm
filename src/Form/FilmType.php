<?php

namespace App\Form;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Categorie;

use App\Entity\Film;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
class FilmType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => 'Titre',
                'required' => true,
                'attr' => [
                    'placeholder' => 'saisir titre',
                                        'class' => 'form-control'

                ]

            ])
            ->add('realisateur', TextType::class, [
                'label' => 'Réalisateur(s)',
                'required' => true,
                'attr' => [
                    'placeholder' => 'saisir réalisateur(s)',
                                        'class' => 'form-control'

                ]

            ])
            ->add('acteur', TextType::class, [
                'label' => 'Acteur(s)',
                'required' => true,
                'attr' => [
                    'placeholder' => 'saisir acteur(s)',
                                        'class' => 'form-control'

                ]

            ])



            ->add('langue', TextType::class, [
                'label' => 'Langue',
                'required' => true,
                'attr' => [
                    'placeholder' => 'saisir langue',
                                        'class' => 'form-control'

                ]

            ])
                  ->add('anneesortie', DateType::class, [
                'label' => 'Année sortie',
                    'widget' => 'single_text',

                'required' => true,
                'attr' => [

                                        'class' => 'form-control'

                ]

            ])
                      ->add('categorie', EntityType::class, [
        'label'=>'Categorie',
                                        'placeholder' => 'Choisir catégorie',

        'attr' => array(
                    'class' => 'form-control chosen'),

    'class' => Categorie::class,
    'choice_label' => function ($cat) {
        return $cat->getNom();
    }

        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Film::class,
        ]);
    }
}
