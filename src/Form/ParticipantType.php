<?php

namespace App\Form;

use App\Entity\Participant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParticipantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imageProfil', FileType::class,[
                'label'=>'Image de profil',
                'required'=>false
            ])
            ->add('nom')
            ->add('prenom')
            ->add('telephone')
            ->add('mail', EmailType::class)
            ->add('password', RepeatedType::class,[
                'type'=>PasswordType::class,
                'invalid_message'=>'Les mots de passe doivent correspondre',
                'required' => true,
                'first_options' => array('label' => 'Mot de passe'),
                'second_options' => array ('label' => 'Répéter le mot de passe'),
            ])
            ->add('campus', TextType::class, [
                'attr' => array(
                    'readonly'=>true
                ),
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Participant::class,
        ]);
    }
}
