<?php

namespace App\Repository;

use App\Entity\Answers;
use App\Entity\Questions;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Answers>
 *
 * @method Answers|null find($id, $lockMode = null, $lockVersion = null)
 * @method Answers|null findOneBy(array $criteria, array $orderBy = null)
 * @method Answers[]    findAll()
 * @method Answers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnswersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Answers::class);
    }

    public function add(Answers $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Answers $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


    public function getUserAnswer($userId, $quizId)
    {
      return $this->getEntityManager()
             ->createQuery(
             'SELECT count(a.id) as nbr_answer,a.user_id,
             From App\Entity\Quiz as q, App\Entity\Answers as a, 
              where a.user_id=:userId and q.id=:quizId
               
             '
             )
             ->setParameter('userId', $userId)
             ->setParameter('quizId', $quizId)
             ->getResult();
     }

     public function userAnswer($userId, $quizId)
     {
       $qb= $this->createQueryBuilder('a');
      return $qb->select("count(a.id)" ,('a.user_id')) 
          ->from('App\Entity\Quiz','q')
          ->where($qb->expr()->eq('a.user_id', ':userId'))
          ->andWhere($qb->expr()->eq('q.id',':quizId'))
                 
   
         ->setParameter('userId', $userId)
         ->setParameter('quizId', $quizId)
         ->getQuery()

         ->execute();
           
     }  
 

    public function userOrderByAnswer($quizId){
        // dd($this->getEntityManager()
        // ->createQuery(
        // 'SELECT count(a.option_id) as nbr_right_answer,a.user_id ,u.user_first_name
        // From App\Entity\Questions as q , App\Entity\Answers as a ,App\Entity\User as u
        // where a.option_id = q.correction and q.quiz_id=:quizId 
          
        // group by a.user_id
        // ORDER by nbr_right_answer desc   
        // '
        // )
        // ->setParameter('quizId', $quizId)
        // ->getSql());
      return $this->getEntityManager()
             ->createQuery(
             'SELECT count(a.option_id) as nbr_right_answer,a.user_id ,u.user_first_name
             From App\Entity\Questions as q , App\Entity\Answers as a ,App\Entity\User as u
             where a.option_id = q.correction and q.quiz_id=:quizId and a.user_id=u.id
               
             group by a.user_id
             ORDER by nbr_right_answer desc   
             '
             )
             ->setParameter('quizId', $quizId)

             ->getResult();

     }


     public function userOrderByAnswer2($quizId)
     {
       $qb= $this->createQueryBuilder('a');
       $qb->select('count(a.option_id)' ,('a.user_id')) 
          ->from('App\Entity\Questions','q')
          ->where($qb->expr()->eq('a.option_id', 'q.correction'))
          ->groupBy('a.user_id')
          ->orderBy('count(option_id)', 'DESC');
      }  

//    /**
//     * @return Answers[] Returns an array of Answers objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Answers
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
