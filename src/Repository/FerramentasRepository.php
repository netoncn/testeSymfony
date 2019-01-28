<?php

namespace App\Repository;

use App\Entity\Ferramentas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Ferramentas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ferramentas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ferramentas[]    findAll()
 * @method Ferramentas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FerramentasRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Ferramentas::class);
    }

    // /**
    //  * @return Ferramentas[] Returns an array of Ferramentas objects
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
    public function findOneBySomeField($value): ?Ferramentas
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findMaxId(){
        $qb = $this->createQueryBuilder('f')
        ->select('MAX(f.cod_ferramenta)')
        // ->from('Ferramentas', 'f')
        ->getQuery()
        ->getSingleScalarResult();
        return $qb;
    }

    public function prepareForm($request,Ferramentas $ferramenta){
        $max = $this->findMaxId();
        if(!$max) $max = 0;
        $max++;
        $ferramenta->setCodFerramenta($max);

        return $ferramenta;
    }
}
