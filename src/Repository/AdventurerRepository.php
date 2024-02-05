<?php

namespace App\Repository;

use App\Entity\Adventurer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Adventurer>
 *
 * @method Adventurer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Adventurer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Adventurer[]    findAll()
 * @method Adventurer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdventurerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Adventurer::class);
    }

    public function search($searchTerm): array
    {
        return $this->createQueryBuilder('a')
            ->where('a.name like :name')
            ->setParameter('name', "%$searchTerm%")
            ->getQuery()->getResult()
        ;
    }
}
