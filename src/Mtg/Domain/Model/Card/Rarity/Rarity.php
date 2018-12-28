<?php

namespace Mtg\Domain\Model\Card\Rarity;

class Rarity
{
    public const COMMON   = "common";
    public const UNCOMMON = "uncommon";
    public const RARE     = "rare";
    public const MYTHIC   = "mythic";

    public const ALL = [
        self::COMMON,
        self::UNCOMMON,
        self::RARE,
        self::MYTHIC
    ];
}