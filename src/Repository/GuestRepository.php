<?php

namespace App\Repository;

use App\Entity\Guest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Guest>
 */
class GuestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Guest::class);
    }

    //    /**
    //     * @return Guest[] Returns an array of Guest objects
    //     */
    public function findGuestsByUserEmail(string $email): array
    {
        return $this->createQueryBuilder('g') // 'g' est Guest
            ->join('g.famillygroup', 'fg') // Relation Guest → FamillyGroup
            ->join('fg.user', 'u') // Relation FamillyGroup → User
            ->where('u.email = :email') // Condition sur l'email
            ->setParameter('email', $email)
            ->select('g') // Sélectionner les invités (Guest)
            ->getQuery()
            ->getResult();
    }

    //    public function findOneBySomeField($value): ?Guest
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
