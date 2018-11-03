<?php
/**
 * Created by PhpStorm.
 * User: sjoerddewaard
 * Date: 13/10/2018
 * Time: 11:20
 */

declare(strict_types = 1);

namespace Mtg\Infrastructure\Persistence\Doctrine;

use Doctrine\ORM\EntityRepository;
use Mtg\Domain\Model\Card\Card;
use Mtg\Domain\Model\Card\CardRepositoryInterface;

final class DoctrineCardRepository extends EntityRepository implements CardRepositoryInterface
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
     * @return Card
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function store(Card $card): void
    {
        $this->getEntityManager()->persist($card);
        $this->getEntityManager()->flush();
    }

}