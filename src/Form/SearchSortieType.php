<?php

namespace App\Form;

use App\Entity\SearchSortie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchSortieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder
            ->add('listeCampus', ChoiceType::class, [
                'label' => 'Campus',
                'choices' => [
                    'Campus de Nantes'=> 'Nantes',
                    'Campus de Niort'=> 'Niort',
                    'Campus de Rennes'=> 'Rennes',
                    'Campus de Quimper'=> 'Quimper',
                ]
            ])
            ->add('checkBox', ChoiceType::class, [
                'label'=> false,
                'choices' => [
                    'Sorties dont je suis organisateur/trice' => 'Orga',
                    'Sorties auxquelles je suis inscrit/e' => 'Inscrit',
                    'Sorties auxquelles je ne suis pas inscrit/e' => 'NoInscrit',
                    'Sorties passées' => 'Finies'
                ],
                'multiple' => true,
                'expanded'=> true,

            ])

            -> add('searchBar', TextareaType::class, [
                'label' => 'Le nom de la sortie contient',
                'attr' => [
                    'placeholder' => 'Search',
                ]
            ])

            ->add('dateMin', DateType::class, [
                'label'=> 'Entre',
                'widget' => 'choice',
            ])

            ->add('dateMax', DateType::class, [
                'label'=> 'et',
                'widget' => 'choice',
            ])


        ->add('Rechercher', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver -> setDefaults([
            'data_class' =>SearchSortie::class,
            'method' => 'get',
            'csrf_protection'=> false
        ]);
    }

    public function getBlockPrefix(){
        return '';
}

}