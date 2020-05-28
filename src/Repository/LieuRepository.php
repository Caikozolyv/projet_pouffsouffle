<?php

namespace App\Repository;

use App\Entity\Lieu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Lieu|null find($id, $lockMode = null, $lockVersion = null)
 * @method Lieu|null findOneBy(array $criteria, array $orderBy = null)
 * @method Lieu[]    findAll()
 * @method Lieu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LieuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Lieu::class);
    }

     /**
      * @return Lieux[] Returns an array of Lieux objects
      */
    public function findLieuxByVilleId($villeId)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.ville = :val')
            ->setParameter('val', $villeId)
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?Lieux
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findLieu (Lieu $lieu)

    {
        return $this->createQueryBuilder('s')

            ->andWhere('s.lieu = :lieu')

            ->setParameter('lieu', $lieu->getIdLieu())
            ->setParameter('lieu', $lieu->getNomLieu())
            ->setParameter('lieu', $lieu->getRue())
            ->setParameter('lieu', $lieu->getLatitude())
            ->setParameter('lieu', $lieu->getLongitude())
            ->setParameter('lieu', $lieu->getListeSorties()) //Liste

            ->getQuery()
            ->getResult();

    }
}
