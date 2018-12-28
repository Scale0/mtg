<?php
declare(strict_types = 1);

namespace Mtg\Infrastructure\Container\Infrastructure\Card;

use Doctrine\ORM\EntityRepository;
use Mtg\Domain\Model\Card\CardRepositoryInterface;
use Mtg\Domain\Model\Card\Card;

class DoctrineCardRepository extends EntityRepository implements CardRepositoryInterface
{
    /**
     * @param $cardId
     *
     * @return Card|null
     */
    public function getCard($cardId): ?Card
    {
        return $this->find($cardId);
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->findAll();
    }

    /**
     * @param Card $card
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function store(Card $card): void
    {
        $this->getEntityManager()->persist($card);
        $this->getEntityManager()->flush($card);
    }
}