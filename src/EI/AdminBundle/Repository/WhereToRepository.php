<?php

namespace EI\AdminBundle\Repository;

/**
 * WhereToRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class WhereToRepository extends \Doctrine\ORM\EntityRepository
{
    public function myFindAll()
    {

      $queryBuilder = $this->createQueryBuilder('w');

      // On récupère la Query à partir du QueryBuilder
      $query = $queryBuilder->getQuery();

      // On récupère les résultats à partir de la Query
      $results = $query->getResult();

      // On retourne ces résultats
      return $results;
    }
    
    public function myFindOne($whereToId)
    {
      $qb = $this->createQueryBuilder('w');

      $qb
        ->where('w.id = :whereToId')
        ->setParameter('whereToId', $whereToId)
        ->leftJoin('w.brs', 'brs')
              ->addSelect('brs')
      ;

      return $qb
        ->getQuery()
        ->getOneOrNullResult()
      ;
    }
    
     public function getWhereToWithCategory()
  {
    $qb = $this ->createQueryBuilder('whe');
    
    $qb->leftJoin('whe.categories', 'cat')
    ->addSelect('cat');

  return $qb
    ->getQuery()
    ->getResult()
  ;
  }
  
}
