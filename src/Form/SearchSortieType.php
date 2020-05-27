<?php

namespace App\Form;

use App\Entity\FindSortie;
use App\Entity\Sortie;
use App\Entity\Lieu;
use App\Entity\Campus;
use App\Entity\Ville;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use function Sodium\add;

class SearchSortieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('campus', EntityType::class, [
                'class' => Campus::class,
                'label' => "Campus",
                'query_builder' => function(EntityRepository $repository) {
                    return $repository->createQueryBuilder('c')->orderBy('c.nom', 'ASC');
                }
            ])
            ->add('name', TextType::class, [
                'label' => "Le nom de la sortie contient : ",
                'required'=>false
            ])

            ->add('premiereDate',  DateTimeType::class, [
                'label' => 'Entre le ',
            ])

            ->add('deuxiemeDate',  DateTimeType::class, [
                'label' => 'Et le',
            ])

            ->add('organisateur', CheckboxType::class, [
                'label'    => 'Je suis Organisateur',
                'required' => false,
            ])
            ->add('inscrit', CheckboxType::class, [
                'label'    => 'Sorties auxquelles je suis inscrit/e',
                'required' => false,
            ])
            ->add('pasinscrit', CheckboxType::class, [
                'label'    => 'Sorties auxquelles je ne suis pas inscrit/e',
                'required' => false,
            ])
            ->add('passees', CheckboxType::class, [
                'label'    => 'Sorties passées',
                'required' => false,
            ]);


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver -> setDefaults([
            'data_class' =>FindSortie::class,
            'method' => 'get',
            'csrf_protection'=> false
        ]);
    }

    public function getBlockPrefix(){
        return '';
}

}