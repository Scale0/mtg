<?php
declare(strict_types = 1);

namespace Mtg\Domain\Model\Card;

interface CardRepositoryInterface
{
    public function getCard($cardId): ?Card;

    public function getAll(): array;

    public function store(Card $card): void;
}