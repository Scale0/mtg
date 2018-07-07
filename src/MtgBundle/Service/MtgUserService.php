<?php

namespace MtgBundle\Service;

use Doctrine\ORM\EntityManager;

class MtgUserService extends MtgService
{
    /**
     * @var EntityManager
     */
    protected $em;
    public function __construct(EntityManager $entityManager) {
        $this->em = $entityManager;
    }

    public function getUserByUserName($username)
    {
        return $this->em->getRepository('MtgBundle:User')->findOneBy(['username'=>$username]);
    }
}