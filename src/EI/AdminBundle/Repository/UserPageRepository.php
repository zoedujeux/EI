<?php

namespace EI\AdminBundle\Repository;

/**
 * UserPageRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserPageRepository extends \Doctrine\ORM\EntityRepository
{
     public function myFindAll()
    {

      $queryBuilder = $this->createQueryBuilder('u');

      // On récupère la Query à partir du QueryBuilder
      $query = $queryBuilder->getQuery();

      // On récupère les résultats à partir de la Query
      $results = $query->getResult();

      // On retourne ces résultats
      return $results;
    }
}