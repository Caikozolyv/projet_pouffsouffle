<?php

namespace App\Repository;

use App\Entity\Campus;
use App\Entity\Etat;
use App\Entity\FindSortie;
use App\Entity\Lieu;
use App\Entity\Participant;
use App\Entity\Sortie;
use App\Entity\Ville;
use Cassandra\Date;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Constraints\IsNull;

/**
 * @method Sortie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sortie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sortie[]    findAll()
 * @method Sortie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SortieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sortie::class);
    }

    public function findAllVisible(): array
    {
        return $this->findAll();
    }

    public function findAllSortieQuery(): Query
    {
        return $this->findAll()
            ->getQuery();

    }

    public function findAllByUser($user)
    {
        return $this->createQueryBuilder('s')
            ->andWhere(':user MEMBER OF s.listeParticipants')
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult();
    }

    public function findAllManuel()
    {
        $qb = $this->createQueryBuilder('s');
        $qb->join('s.campus', 'c')
            ->addSelect('s.name')
            ->addSelect('s.dateHeureDebut')
            ->addSelect('s.duree')
            ->addSelect('s.infosSortie')
            ->addSelect('s.idSortie')
            ->addSelect('s.dateLimiteInscription')
            ->addSelect('s.nbInscriptionMax')
            ->addSelect('s.etat')
            ->addSelect('c.nom');

        $query = $qb->getQuery();
        return $query
            ->getResult();


    }



    public function findAllBySearch(FindSortie $findSortie, Participant $participant)
    {
        $qb = $this->createQueryBuilder('s');
        $qb->join('s.campus', 'c')
            ->addSelect('s.name')
            ->addSelect('s.dateHeureDebut')
            ->addSelect('s.duree')
            ->addSelect('s.infosSortie')
            ->addSelect('s.idSortie')
            ->addSelect('s.dateLimiteInscription')
            ->addSelect('s.nbInscriptionMax')
            ->addSelect('s.etat')
            ->addSelect('c.nom');

        if ($findSortie->getName() != null) {

            $qb->setParameter('name', '%'.$findSortie->getName().'%')
                ->andWhere('s.name = :name');
        }
        $dateBasique = new \DateTime();
        $dateBasique->setTimestamp(1420070400);

        if ($findSortie->getPremiereDate() != $dateBasique) {
            $qb->setParameter('premiereDate', $findSortie->getPremiereDate())
                ->andWhere('s.dateHeureDebut > :premiereDate');
        }

        if ($findSortie->getDeuxiemeDate() != $dateBasique) {
            $qb->setParameter('deuxiemeDate', $findSortie->getDeuxiemeDate())
                ->andWhere('s.dateHeureDebut < :deuxiemeDate');
        }

        if ($findSortie->getOrganisateur() != false) {
            $qb->join('s.organisateur', 'o')
                ->setParameter('organisateur', $participant->getIdParticipant())
                ->andWhere('o.idParticipant = :organisateur');
        }

        if ($findSortie->isInscrit() != false) {
            $listeId = [-1,-2,-3,-2,-5,-6];
            $liste = $participant->getListeSortiesDuParticipant();

            if($liste != null) {
                foreach ($liste as $sortie) {
                    if ($sortie instanceof Sortie) {
                        $listeId->push($sortie->getIdSortie());
                    }
                }
            }
            $qb->setParameter('ids', array_values($listeId))
                ->andWhere('s.idSortie IN (:ids)');
        }

/*        if ($findSortie->isPasinscrit() != false) {
            $qb->setParameter('pasinscrit', $findSortie->isPasinscrit())
                ->andWhere('s.pasinscrit = :pasinscrit');
        }*/

        if ($findSortie->isPassees() != false) {
            $passee = "Activité passée";
            $qb->setParameter('passee', $passee)
                ->andWhere('s.etat LIKE :passee');
        }
            $query = $qb->getQuery();
        return $query
            ->getResult();

    }
    // /**
    //  * @return Sortie[] Returns an array of Sortie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Sortie
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findSortie(
        Sortie $sortie,
        Lieu $lieu,
        Campus $campus,
        Ville $ville,
        Etat $etat)

    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.sortie = :sortie')
            ->andWhere('s.lieu = :lieu')
            ->andWhere('s.campus = :campus')
            ->andWhere('s.ville = :ville')
            ->setParameter('sortie', $sortie->getIdSortie())
            ->setParameter('sortie', $sortie->getName()) //Pour la création d'un sortie
            ->setParameter('sortie', $sortie->getDateHeureDebut()) //Pour la création d'un sortie
            ->setParameter('sortie', $sortie->getDateLimiteInscription()) //Pour la création d'un sortie
            ->setParameter('sortie', $sortie->getNbInscriptionMax()) //Pour la création d'un sortie
            ->setParameter('sortie', $sortie->getDuree()) //Pour la création d'un sortie
            ->setParameter('sortie', $sortie->getInfosSortie()) //Pour la création d'un sortie

            ->setParameter('etat', $etat->getId()) //Bizarre normalement je devrais avoir getIdEtat et pas getId
            ->setParameter('etat', $etat->getLibelle())
            ->setParameter('campus', $campus->getNom()) //Pour la création d'un sortie

            ->setParameter('lieu', $lieu->getNomLieu()) //Pour la création d'un sortie
            ->setParameter('lieu', $lieu->getRue()) //Pour la création d'un sortie
            ->setParameter('lieu', $lieu->getLatitude()) //Pour la création d'un sortie
            ->setParameter('lieu', $lieu->getLongitude()) //Pour la création d'un sortie

            ->setParameter('ville', $ville->getCodePostal()) //Pour la création d'un sortie

            ->getQuery()
            ->getResult();

    }

}
