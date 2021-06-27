<?php

namespace App\Form;
use App\Entity\Emprunt;

use App\Entity\DVD;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Repository\FilmRepository;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmpruntType extends AbstractType
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
        /*->add('livre', EntityType::class, [
        'label'=>'Livre',
        'attr' => array(
                    'class' => 'form-control'),

    'class' => Livre::class,
        'choices' => $this->livreRepository->findByLivre('Disponible'),

    'choice_label' => function ($livreRepository) {
        return $livreRepository->getTitre();
    }
])*/
->add('user', EntityType::class, [
        'label'=>'Client',
            'class' => User::class,


'attr' => array('class' => ' form-control', 'multiple'=>false,'tabindex'=>'7'

),




    'choices' => $this->userRepository->findByRole('ROLE_USER'),
  'choice_label' => function ($userRepository) {
       // return $userRepository->getNom()->getPrenom();
               // return $userRepository->getPrenom();
        return $userRepository->getNom() . ' ' . $userRepository->getPrenom() ;
    }
])
        ->add('datedebut',DateType::class, array(
                'label' => 'Date Début ',
                'required' => true,
            'widget' => 'single_text',

            'data' => new \DateTime(),
            'attr' => ['class' => 'form-control '],
           ))


         ->add('datefin',DateType::class, array(
                'label' => 'Date fin ',
                'required' => true,
            'widget' => 'single_text',

            'attr' => ['class' => 'form-control date-picker'],
            ))


      /*  ->add('daterendu',DateType::class, array(
                'label' => 'Date Retour* ',
                'required' => true,
            'widget' => 'single_text',
            'html5' => false,
            'data' => new \DateTime(),
            'attr' => ['class' => 'form-control datepicker'],
            'format' => 'dd-MM-yyyy'))
->add('etat',ChoiceType::class,array(
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Emprunt::class,
        ]);
    }
}
