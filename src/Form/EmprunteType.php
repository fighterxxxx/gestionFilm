<?php

namespace App\Form;
use App\Entity\Film;

use App\Entity\DVD;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
//use App\Repository\LivreRepository;
//use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmprunteType extends AbstractType
{
        private $userRepository;
       // private $livreRepository;



    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('dvd', EntityType::class, [
        'label'=>'DVD',
        'attr' => array(
                    'class' => 'form-control'),

    'class' => DVD::class,
    'disabled' => true,

    'choice_label' => function ($dvd) {
       //$dvd->getFilm();
        return $dvd->getFilm()->getTitre();
    }
])


 ->add('datedebut',DateType::class, array(
                'label' => 'Date Début ',
                'required' => true,
'disabled' => true,
            'widget' => 'single_text',

            'data' => new \DateTime(),
            'attr' => ['class' => 'form-control
            '],
            ))

        ->add('datefin',DateType::class, array(
                'label' => 'Date Fin ',
                'disabled' => true,
                'required' => true,
            'widget' => 'single_text',


            'attr' => ['class' => 'form-control '],
            ))
        ->add('daterendu',DateType::class, array(
                'label' => 'Date Rendu ',
                'required' => true,
            'widget' => 'single_text',


            'attr' => ['class' => 'form-control'],
           ))

 /* ->add('etat',ChoiceType::class,array(
                'choices'=>[
                    'En cours'=>'En cours',
                    'Retour' => 'Retour',

                                 ],
                'multiple'=>false,
                'required' => True,
                'expanded'=>false,
                'attr'=>['class'=>'form-control']
            ))
*/
                  /*  ->add('agent', EntityType::class, [
        'label'=>'Agent',
            'class' => User::class,


        'attr' => array(
        'class' => 'form-control'),


    'choices' => $this->userRepository->findByRole('ROLE_AGENT'),
  'choice_label' => function ($userRepository) {
       // return $userRepository->getNom()->getPrenom();
               // return $userRepository->getPrenom();
        return $userRepository->getNom() . ' ' . $userRepository->getPrenom();

    }
])
*/
;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
