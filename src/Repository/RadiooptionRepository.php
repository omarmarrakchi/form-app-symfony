<?php

namespace App\Repository;

use App\Entity\Radiooption;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Radiooption>
 *
 * @method Radiooption|null find($id, $lockMode = null, $lockVersion = null)
 * @method Radiooption|null findOneBy(array $criteria, array $orderBy = null)
 * @method Radiooption[]    findAll()
 * @method Radiooption[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RadiooptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Radiooption::class);
    }

//    /**
//     * @return Radiooption[] Returns an array of Radiooption objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Radiooption
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
