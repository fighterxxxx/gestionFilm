<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           ->add('nom', TextType::class, [
                'label' => 'Nom ',
                'required' => true,
                'attr' => [
                    'placeholder' => 'saisir nom',
                                        'class' => 'form-control'

                ]

            ])
           ->add('Prenom', TextType::class, [
                'label' => 'Prénom',
                'required' => true,
                'attr' => [
                    'placeholder' => 'saisir prenom',
                                        'class' => 'form-control'

                ]

            ])


            ->add('email', TextType::class, [
                'label' => 'email',
                'required' => true,
                'attr' => [
                    'placeholder' => 'email',
                                        'class' => 'form-control'

                ]

            ])
            ->add('username', TextType::class, [
                'label' => 'Nom utilisateur',
                'required' => true,
                'attr' => [
                    'placeholder' => 'saisir nom utilisateur',
                                        'class' => 'form-control'

                ]

            ])
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                 'first_options' => array('label' => 'Mot de passe ', 'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'saisir mot de passe',


                )),
                'second_options' => array('label' => 'Répéter mot de passe', 'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'répéter mot de passe',

                )),
            ))

             //    ->add('roles')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));
    }
}
