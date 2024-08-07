<?php

namespace App\Repository;

use App\Entity\Responseform;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Responseform>
 *
 * @method Responseform|null find($id, $lockMode = null, $lockVersion = null)
 * @method Responseform|null findOneBy(array $criteria, array $orderBy = null)
 * @method Responseform[]    findAll()
 * @method Responseform[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResponseformRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Responseform::class);
    }

//    /**
//     * @return Responseform[] Returns an array of Responseform objects
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

//    public function findOneBySomeField($value): ?Responseform
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
