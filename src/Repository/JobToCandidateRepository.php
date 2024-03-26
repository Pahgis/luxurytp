<?php

namespace App\Repository;

use App\Entity\JobToCandidate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<JobToCandidate>
 *
 * @method JobToCandidate|null find($id, $lockMode = null, $lockVersion = null)
 * @method JobToCandidate|null findOneBy(array $criteria, array $orderBy = null)
 * @method JobToCandidate[]    findAll()
 * @method JobToCandidate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JobToCandidateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JobToCandidate::class);
    }

//    /**
//     * @return JobToCandidate[] Returns an array of JobToCandidate objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('j.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?JobToCandidate
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
