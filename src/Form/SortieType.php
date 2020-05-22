<?php

namespace App\Form;

use App\Entity\Sortie;
use App\Entity\Lieu;
use App\Entity\Campus;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SortieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => "Nom de la sortie : "
            ])
            ->add('dateHeureDebut')
            ->add('dateLimiteInscription')
            ->add('nbInscriptionMax', IntegerType::class, [
                'label' => "Nombre de places : "
            ])
            ->add('duree', IntegerType::class, [
                'label' => "Durée : "
            ])
            ->add('infosSortie', TextareaType::class, [
                'label' =>"Description et infos : ",
                'attr' => [
                    'class' => 'overview-txt'
                ]
            ])
            ->add('campus', EntityType::class, [
                'class' => Campus::class,
                'label' => "Campus"
            ])
            //->add('ville')
            ->add('lieu', EntityType::class, [
                'class' => Lieu::class,
                'label' => "Lieu"
            ])
            //->add('rue')
            //->add('codePostal')
            //->add('latitude', EntityType::class, [
            //    'class' => Lieu::class,
            //    'label' => "Latitude"
            //])
            // ->add('longitude')

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sortie::class,
        ]);
    }
}
