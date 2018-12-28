<?php

namespace Mtg\Infrastructure\Container\Infrastructure\Card\CardFace;

use Doctrine\ORM\EntityRepository;
use Mtg\Domain\Model\Card\CardFace\CardFace;
use Mtg\Domain\Model\Card\CardFace\CardFaceRepositoryInterface;

class DoctrineCardFaceRepository extends EntityRepository implements CardFaceRepositoryInterface
{
    /**
     * @param $cardFaceId
     *
     * @return CardFace|null
     */
    public function getCardFace($cardFaceId): ?CardFace
    {
        return $this->find($cardFaceId);
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->findAll();
    }

    /**
     * @param CardFace $cardFace
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function store(CardFace $cardFace): void
    {
        $this->getEntityManager()->persist($cardFace);
        $this->getEntityManager()->flush();
    }

}