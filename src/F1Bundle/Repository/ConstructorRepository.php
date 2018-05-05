<?php
namespace F1Bundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ConstructorRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ConstructorRepository extends EntityRepository
{
    /**
     * @param $code
     *
     * @return null|object
     */
    public function findOneByConstructorId($constructorId)
    {
        return $this->findOneBy(['constructorId' => $constructorId]);
    }
}
