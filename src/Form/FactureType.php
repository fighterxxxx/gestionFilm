<?php

namespace App\Form;
use App\Entity\Client;
use App\Entity\User;
use App\Entity\Facture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class FactureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('reference', TextType::class, [
                'label' => 'Référence',
                'required' => true,
                'attr' => [
                    'placeholder' => 'saisir référence',
                                        'class' => 'form-control'

                ]

            ])


          /*  ->add('editeur', EntityType::class, [
        'label'=>'Editeur',
        'attr' => array(
                    'class' => 'form-control'),

    'class' => User::class,
    'choice_label' => function ($user) {
        return $user->getUsername();
    }

])
       */
	   ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Facture::class,
        ]);
    }
}
