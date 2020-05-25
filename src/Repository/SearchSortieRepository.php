<?php

namespace App\Repository;
use App\Entity\Ville;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ville|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ville|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ville[]    findAll()
 * @method Ville[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SearchSortieRepository extends ServiceEntityRepository
{
    public function __construct(SearchSortieRepository $repository, ManagerRegistry $registry)
    {
        parent::__construct($registry, Ville::class);
    }
}