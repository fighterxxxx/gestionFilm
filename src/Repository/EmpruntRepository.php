<?php

namespace App\Repository;

use App\Entity\Emprunt;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Emprunt|null find($id, $lockMode = null, $lockVersion = null)
 * @method Emprunt|null findOneBy(array $criteria, array $orderBy = null)
 * @method Emprunt[]    findAll()
 * @method Emprunt[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmpruntRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Emprunt::class);
    }
     public function findByEmprunt($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.etat = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

public function findbyNbredvdemprunte($iddvd){

       $dql_query = $this->_em->createQuery("
    SELECT count(u.id) FROM App:Emprunt u
    WHERE

  u.etat LIKE '%Encours%' AND u.dvd=$iddvd
   "

        );

        $nbrecopieencours=$dql_query->getSingleScalarResult();

        return $nbrecopieencours;
    }
    public function findbyLastlivreemprunts($vallimit=3)
    {

        $dql_query = $this->_em->createQuery("
    SELECT u FROM App\Entity\Emprunt u
    ORDER BY

   u.dateajout DESC "

        );
        $dql_query ->setMaxResults($vallimit);
        $lastlogs= array_reverse($dql_query->getResult());

        return $lastlogs;
            }

              public function findbyLastlivreemprunt($iduser,$vallimit=10)
    {

        $dql_query = $this->_em->createQuery("
    SELECT u FROM App\Entity\Emprunt u
   WHERE u.etat LIKE '%Encours%' AND u.user=$iduser
      ORDER BY

   u.dateajout DESC
   "

        );
        $dql_query ->setMaxResults($vallimit);
        $lastlogs= array_reverse($dql_query->getResult());

        return $lastlogs;
            }



    // /**
    //  * @return Emprunt[] Returns an array of Emprunt objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Emprunt
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findByUser($iduser)
    {

        $dql_query = $this->_em->createQuery("
    SELECT u FROM App\Entity\Emprunt u
   WHERE

   u.user=$iduser

       " );
        $lastlogs= $dql_query->getResult();

        return $lastlogs;
            }
            public function findbyNbredvdEmprunteMois($yearmois){

       $dql_query = $this->_em->createQuery("
    SELECT count(u.id) FROM App:Emprunt u
    WHERE

  u.dateajout LIKE '%".$yearmois."%'  "

        );

        $nbrelivre=$dql_query->getSingleScalarResult();

        if( $nbrelivre==null){
            $nbrelivre=0;

        }
        return $nbrelivre;
    }
        public function findbyNbredvdEmprunteMoiss($iduser,$yearmois){

       $dql_query = $this->_em->createQuery("
    SELECT count(u.id) FROM App:Emprunt u
    WHERE

  u.dateajout LIKE '%".$yearmois."%' AND u.user=$iduser "

        );

        $nbrelivre=$dql_query->getSingleScalarResult();

        if( $nbrelivre==null){
            $nbrelivre=0;

        }
        return $nbrelivre;
    }
    public function findByEtat($etat)
    {
   return $this->createQueryBuilder('e')
            ->andWhere('e.etat = :val')
            ->setParameter('val', $etat)
            ->orderBy('e.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
  public function findByusername($username)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.username = :val')
            ->setParameter('val', $username)
            ->orderBy('e.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }
    public function findByemail($email)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.email = :val')
            ->setParameter('val', $email)
            ->orderBy('e.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }
    public function findbyuseremprunt($iduser)

       {
        $dql_query = $this->_em->createQuery("
    SELECT e FROM App\Entity\Emprunt e  JOIN e.user u
        WHERE

   e.user='".$iduser."'


   "

        );
       // $dql_query ->setMaxResults($vallimit);
        $user= $dql_query->getResult();

        return $user;
    }

    // /**
    //  * @return Emprunt[] Returns an array of Emprunt objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Emprunt
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
