<?php

namespace App\Services\Number\Infrastructure\Repository;

use App\Services\Number\Domain\Model\Number;
use App\Services\Number\Infrastructure\Mapper\AggregateMapper;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Number|null find($id, $lockMode = null, $lockVersion = null)
 * @method Number|null findOneBy(array $criteria, array $orderBy = null)
 * @method Number[]    findAll()
 * @method Number[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NumberRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, protected AggregateMapper $aggregateMapper)
    {
        parent::__construct($registry, Number::class);
    }

     /**
      * @return Number[] Returns an array of Number objects
      * @todo change sqlite to any other db that support regex natively :D
      */
    public function getAll(?int $offset = null, ?int $countryCode = null): array
    {
        $query = $this->createQueryBuilder('n');
        if ($countryCode) {
            $query->where('SUBSTRING(n.phone,2,3) = :code')
                ->setParameter('code', "$countryCode");
        }
        $query->setFirstResult($offset);
        $numbers = $query->getQuery()
            ->getResult();
        return $this->aggregateMapper->mapList($numbers);
    }

}
