<?php
declare(strict_types = 1);

namespace Mtg\Domain\Model\CardSet;

interface CardSetRepositoryInterface
{
    public function getCardSet($cardSetId): ?CardSet;

    public function getAll(): array;

    public function store(CardSet $cardFace): void;
}