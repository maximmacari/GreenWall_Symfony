<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }


##https://www.doctrine-project.org/projects/doctrine-orm/en/2.9/reference/query-builder.html

    
    public function findByCategoryFilter($page)
    {
        $queryBuilder = $this->createQueryBuilder('p')
            ->setFirstResult(24 * ($page - 1)) // offset
            ->setMaxResults(24)
            
        ;

       
        /* for ($i=0; $i < count($selectedCategories); $i++) { 
            $queryBuilder = $queryBuilder
            ->andWhere('p.category = :val')
            ->setParameter('val', $selectedCategories[$i]);
        } */

        $query = $queryBuilder->getQuery();

        dump($query);

        return new Paginator($query);
    }
    

    /*
    public function findOneBySomeField($value): ?Product
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
