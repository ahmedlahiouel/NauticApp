<?php

namespace App\Repository;

use App\Entity\NauticBase;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method NauticBase|null find($id, $lockMode = null, $lockVersion = null)
 * @method NauticBase|null findOneBy(array $criteria, array $orderBy = null)
 * @method NauticBase[]    findAll()
 * @method NauticBase[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NauticBaseRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, NauticBase::class);
    }

    // /**
    //  * @return NauticBase[] Returns an array of NauticBase objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NauticBase
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
