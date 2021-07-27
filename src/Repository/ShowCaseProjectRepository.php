<?php

namespace App\Repository;

use App\Entity\ShowCaseProject;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ShowCaseProject|null find($id, $lockMode = null, $lockVersion = null)
 * @method ShowCaseProject|null findOneBy(array $criteria, array $orderBy = null)
 * @method ShowCaseProject[]    findAll()
 * @method ShowCaseProject[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShowCaseProjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ShowCaseProject::class);
    }

    // /**
    //  * @return ShowCaseProject[] Returns an array of ShowCaseProject objects
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
    public function findOneBySomeField($value): ?ShowCaseProject
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
