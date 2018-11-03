<?php
/**
 * Created by PhpStorm.
 * User: sjoerddewaard
 * Date: 13/10/2018
 * Time: 11:20
 */

namespace Mtg\Infrastructure\Persistence\Doctrine;

use Doctrine\ORM\EntityRepository;
use Mtg\Domain\Model\Card\Card;
use Mtg\Domain\Model\Card\CardRepositoryInterface;

class DoctrineCardRepsitory extends EntityRepository implements CardRepositoryInterface
{
    public function getCard($cardId): Card
    {
        // TODO: Implement getCard() method.
    }

    public function getAll(): array
    {
        // TODO: Implement getAll() method.
    }

    public function store(Card $card): void
    {
        // TODO: Implement store() method.
    }

}