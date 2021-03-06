<?php

namespace App\Repository;

use App\Entity\BrandSketch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BrandSketch|null find($id, $lockMode = null, $lockVersion = null)
 * @method BrandSketch|null findOneBy(array $criteria, array $orderBy = null)
 * @method BrandSketch[]    findAll()
 * @method BrandSketch[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BrandSketchRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BrandSketch::class);
    }

     /**
      * @return BrandSketch[] Returns an array of BrandSketch objects
      */
    public function findAllNotRemoved()
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.isRemoved = 0')
            ->orderBy('b.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findAllSketchesNotRemoved()
    {
        return $this->createQueryBuilder('b')
            ->leftJoin('b.quote', 'q')
            ->andWhere('q.isRemoved = 0')
            ->andWhere('b.isRemoved = 0')
            ->orderBy('b.id', 'DESC')
            ->getQuery()
            ->getResult();
    }


    /*
    public function findOneBySomeField($value): ?BrandSketch
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
