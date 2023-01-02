<?php

namespace App\Repository;

use App\Entity\QuizQuestionsOptions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<QuizQuestionsOptions>
 *
 * @method QuizQuestionsOptions|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuizQuestionsOptions|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuizQuestionsOptions[]    findAll()
 * @method QuizQuestionsOptions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuizQuestionsOptionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuizQuestionsOptions::class);
    }

    public function add(QuizQuestionsOptions $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(QuizQuestionsOptions $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return QuizQuestionsOptions[] Returns an array of QuizQuestionsOptions objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('q')
//            ->andWhere('q.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('q.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?QuizQuestionsOptions
//    {
//        return $this->createQueryBuilder('q')
//            ->andWhere('q.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
