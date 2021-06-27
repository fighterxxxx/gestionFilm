<?php

namespace App\Form;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Film;
use App\Entity\DVD;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class DVDType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('film', EntityType::class, [
        'label'=>'Film',
                                        'placeholder' => 'Choisir film',

        'attr' => array(
                    'class' => 'form-control chosen'),

    'class' => Film::class,
    'choice_label' => function ($film) {
        return $film->getTitre(). ' en ' . $film->getLangue();
    }

        ])
            ->add('nbrcopie', IntegerType::class, [
                'label' => 'Nombre copie',
                'required' => true,
                'attr' => [
                    'placeholder' => 'saisir nbrcopie',
                                        'class' => 'form-control'

                ]

            ])
             ->add('prix', NumberType::class, [
                'label' => 'Prix en euro',
                'required' => true,
                'attr' => [
                    'placeholder' => 'saisir prix',
                                        'class' => 'form-control'

                ]

            ])


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DVD::class,
        ]);
    }
}
