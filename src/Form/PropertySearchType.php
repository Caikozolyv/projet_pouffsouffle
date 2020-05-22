<?php

namespace App\Form;

use App\Controller\CampusController;
use App\Entity\Campus;
use App\Entity\PropertySearch;
use App\Entity\Sortie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertySearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('listeCampus', ChoiceType::class, [
                'required' => false,
                'choices' => $this->getChoices()
            ])

            ->add('dateMin', DateType::class, [
                'required' => false,
            ])

            ->add('dateMax', DateType::class, [
                'required' => false,
            ])

            ->add('search', TextType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Recherche par nom'
                ]
            ])
            ->add('checkbox', CheckboxType::class, [
                'required'=> false
            ])
        ;
    }

    private function getChoices(){
        $choices = (new \App\Entity\Campus)->getNom();
        $output = [];
        foreach ($choices as $k => $v){
            $output[$v] = $k;
        }

        return $output;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PropertySearch::class,
            'method' =>'get',
            'csrf_protection'=> false
        ]);
    }
}
