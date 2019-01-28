<?php

namespace App\Repository;

use App\Entity\Tecnicos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Tecnicos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tecnicos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tecnicos[]    findAll()
 * @method Tecnicos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TecnicosRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Tecnicos::class);
    }

    // /**
    //  * @return Tecnicos[] Returns an array of Tecnicos objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Tecnicos
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function validaForm($request = null){
        $cpf = $request['cpf'];
        if(is_numeric($cpf) && strlen($cpf) == 11){
            if($this->findBy(array('cpf'=>$cpf))){
                return 'CPF já Cadastrado!';
            } else{
                return true;
            }
        } else{
            return 'CPF Inválido!';
        }
    }
}
