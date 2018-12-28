<?php
declare(strict_types = 1);

namespace Mtg\Domain\Model\Card\CardFace;

interface CardFaceRepositoryInterface
{
    public function getCardFace($cardFaceId): ?CardFace;

    public function getAll(): array;

    public function store(CardFace $cardFace): void;
}