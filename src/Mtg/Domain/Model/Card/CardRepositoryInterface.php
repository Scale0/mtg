<?php
/**
 * Created by PhpStorm.
 * User: sjoerddewaard
 * Date: 13/10/2018
 * Time: 11:12
 */

namespace Mtg\Domain\Model\Card;

interface CardRepositoryInterface
{
    public function getCard($cardId): ?Card;

    public function getAll(): array;

    public function store(Card $card): void;
}