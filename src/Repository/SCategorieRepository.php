<?php

namespace App\Repository;

use App\Entity\SCategorie;
use App\Entity\Categorie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SCategorie>
 *
 * @method SCategorie|null find($id, $lockMode = null, $lockVersion = null)
 * @method SCategorie|null findOneBy(array $criteria, array $orderBy = null)
 * @method SCategorie[]    findAll()
 * @method SCategorie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SCategorieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SCategorie::class);
    }

    public function save(SCategorie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(SCategorie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findDuplicates(int $numero, Categorie $categorie): int
    {
        $qb = $this->createQueryBuilder('s')
            ->select('COUNT(s)')
            ->where('s.numero = :numero')
            ->andWhere('s.categorie = :categorie')
            ->setParameter('numero', $numero)
            ->setParameter('categorie', $categorie);

        return $qb->getQuery()->getSingleScalarResult();
    }


//    /**
//     * @return SCategorie[] Returns an array of SCategorie objects
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

//    public function findOneBySomeField($value): ?SCategorie
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
