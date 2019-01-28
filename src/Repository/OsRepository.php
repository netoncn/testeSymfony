<?php

namespace App\Repository;

use App\Entity\Os;
use App\Entity\Servicos;
use App\Repository\ServicosRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Os|null find($id, $lockMode = null, $lockVersion = null)
 * @method Os|null findOneBy(array $criteria, array $orderBy = null)
 * @method Os[]    findAll()
 * @method Os[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Os::class);
    }

    // /**
    //  * @return Os[] Returns an array of Os objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Os
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findMaxId(){
        $qb = $this->createQueryBuilder('o')
        ->select('MAX(o.id)')
        ->getQuery()
        ->getSingleScalarResult();
        return $qb;
    }

    public function prepareForm($request,Os $o){
        $max = $this->findMaxId();
        if(!$max) $max = 0;
        $max++;
        $sequence = $max;

        $servico = substr($o->getServico()->getTipo(),0,2);
        $sequence .= strtoupper($servico);

        $mes = $num_padded = sprintf("%02d", $request['data_servico']['date']['month']);
        $dia = $num_padded = sprintf("%02d", $request['data_servico']['date']['day']);
        $data = $request['data_servico']['date']['year'].$mes.$dia;
        $sequence .= $data;

        $o->setSequence($sequence);

        $tempo_medio_serv = $o->getServico()->getTempoMedio();
        $valor_hora_tecnico = $o->getTecnico()->getValorHora();
        $valorFerramenta = 0;
        foreach($o->getFerramenta() as $ferramenta){
            $valorFerramenta += ($ferramenta->getAluguelHora() * $tempo_medio_serv);
        }
        $valorTotal = $tempo_medio_serv * $valor_hora_tecnico + $valorFerramenta;
        
        $o->setValorTotal($valorTotal);

        return $o;
    }
}
