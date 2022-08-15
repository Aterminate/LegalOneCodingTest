<?php

namespace App\Repository;

use App\Entity\ServiceAnalytic;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ServiceAnalytic>
 *
 * @method ServiceAnalytic|null find($id, $lockMode = null, $lockVersion = null)
 * @method ServiceAnalytic|null findOneBy(array $criteria, array $orderBy = null)
 * @method ServiceAnalytic[]    findAll()
 * @method ServiceAnalytic[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServiceAnalyticRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ServiceAnalytic::class);
    }

    public function add(ServiceAnalytic $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ServiceAnalytic $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ServiceAnalytic[] Returns an array of ServiceAnalytic objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ServiceAnalytic
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
