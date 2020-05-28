<?php

namespace App\Form;

use App\Entity\Sortie;
use App\Entity\Lieu;
use App\Entity\Campus;
use App\Entity\Ville;
use App\Repository\VilleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SortieType extends AbstractType
{
    private $em;

    /**
     * The Type requires the EntityManager as argument in the constructor. It is autowired
     * in Symfony 3.
     *
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

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
                'label' => "Description et infos : ",
                'attr' => [
                    'class' => 'overview-txt'
                ]
            ])
            ->add('campus', EntityType::class, [
                'attr' => [
                    'readonly' => true
                ],
                'class' => Campus::class,
                'label' => "Campus",
                'query_builder' => function (EntityRepository $repository) {
                    return $repository->createQueryBuilder('c')->orderBy('c.nom', 'ASC');
                }
            ])

            ->add('ville', EntityType::class, [
                'mapped' => false,
                'class' => Ville::class,
                'label' => "Ville",
                'placeholder' => 'Choisissez une ville',
                'query_builder' => function (EntityRepository $repository) {
                    return $repository->createQueryBuilder('c')->orderBy('c.nomVille', 'ASC');
                }
            ])

            ->addEventListener(FormEvents::PRE_SET_DATA, array($this, 'onPreSetData'))
            ->addEventListener(FormEvents::POST_SET_DATA, array($this, 'onPostSetData'))
            ->addEventListener(FormEvents::PRE_SUBMIT, array($this, 'onPreSubmit'));
            }

    protected function addElements(FormInterface $form, Ville $ville = null, Lieu $lieu = null)
    {
        dump($ville);
        $lieux = array();
        $lieuSelected = new Lieu();

        if ($ville) {
            $lr = $this->em->getRepository('LieuRepository');
            $lieux = $lr->createQueryBuilder('q')
                ->andWhere("q.ville = :villeId")
                ->setParameter("villeId", $ville->getId())
                ->getQuery()
                ->getResult();
        }

        if ($lieu) {
            $lr = $this->em->getRepository('LieuRepository');
            $lieuSelected = $lr->createQueryBuilder('q')
                ->andWhere("q.idLieu = :lieuId")
                ->setParameter("lieuId", $lieu->getIdLieu())
                ->getQuery()
                ->getResult();
        }
//        dump($lieuSelected->getRue());

        $form->add('lieu', EntityType::class, [
            'class' => Lieu::class,
            'label' => "Lieu",
            'attr' => [
                'disabled' => true
            ],
            'choices' => $lieux
        ])
            ->add('rue', TextType::class, [
                'mapped' => false,
                'disabled' => true,
                'label' => 'Rue : ',
                'data' => $lieuSelected
            ])
            ->add('latitude', TextType::class, [
                'mapped' => false,
                'disabled' => true,
                'label' => 'Latitude : ',
                'data' => $lieuSelected
            ])
            ->add('longitude', TextType::class, [
                'mapped' => false,
                'disabled' => true,
                'label' => 'Longitude : ',
                'data' => $lieuSelected
            ]);

    }

    function onPreSubmit(FormEvent $event, VilleRepository $vr)
    {
        $form = $event->getForm();
        $data = $event->getData();

        $ville = $vr->find($data['ville']);
        dump($ville);

        $this->addElements($form, $ville);
    }

    function onPreSetData(FormEvent $event)
    {
        $form = $event->getForm();
        $ville = $form->get('ville')->getData() ? $form->get('ville')->getData() : null;
//        $lieu = $form->get('lieu')->getData() ? $form->get('lieu')->getData() : null;
        $this->addElements($form, $ville, null);
    }

    function onPostSetData(FormEvent $event)
    {
        $form = $event->getForm();
        $ville = $form->get('ville')->getData() ? $form->get('ville')->getData() : null;
        $lieu = $form->get('lieu')->getData() ? $form->get('lieu')->getData() : null;
        $this->addElements($form, $ville, $lieu);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sortie::class,
        ]);
    }
}
