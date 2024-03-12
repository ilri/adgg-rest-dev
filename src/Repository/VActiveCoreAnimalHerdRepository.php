<?php

namespace App\Repository;

use App\Entity\VActiveCoreAnimalHerd;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VActiveCoreAnimalHerd>
 *
 * @method VActiveCoreAnimalHerd|null find($id, $lockMode = null, $lockVersion = null)
 * @method VActiveCoreAnimalHerd|null findOneBy(array $criteria, array $orderBy = null)
 * @method VActiveCoreAnimalHerd[]    findAll()
 * @method VActiveCoreAnimalHerd[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VActiveCoreAnimalHerdRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VActiveCoreAnimalHerd::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(VActiveCoreAnimalHerd $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(VActiveCoreAnimalHerd $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

}
