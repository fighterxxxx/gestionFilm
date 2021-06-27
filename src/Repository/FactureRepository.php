<?php

namespace App\Repository;

use App\Entity\Facture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Facture|null find($id, $lockMode = null, $lockVersion = null)
 * @method Facture|null findOneBy(array $criteria, array $orderBy = null)
 * @method Facture[]    findAll()
 * @method Facture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FactureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Facture::class);
    }

    public function getReferenceOfLastfacture()
    {
		$year=date('Y');
		 $dql_query = $this->_em->createQuery("
    SELECT count(f.id) FROM App:Facture f
    WHERE

  f.date LIKE '%".$year."%'  "

        );

        $nbrefacture=$dql_query->getSingleScalarResult();

        if( $nbrefacture==null){
            $nbrefacture=0;

        }
        return $nbrefacture;

    }
    public function findByUser($iduser)
    {

        $dql_query = $this->_em->createQuery("
    SELECT u FROM App\Entity\Facture u
   WHERE

   u.editeur=$iduser

       " );
        $lastlogs= $dql_query->getResult();

        return $lastlogs;
            }
    // /**
    //  * @return Facture[] Returns an array of Facture objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Facture
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
