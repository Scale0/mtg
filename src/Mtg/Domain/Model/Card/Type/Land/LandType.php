<?php

namespace Mtg\Domain\Model\Card\Type\Land;

class LandType
{
    public const DESERT     = "desert";
    public const FOREST     = "forest";
    public const GATE       = "gate";
    public const ISLAND     = "island";
    public const LAIR       = "lair";
    public const LOCUS      = "locus";
    public const MINE       = "mine";
    public const MOUNTAIN   = "mountain";
    public const PLAINS     = "plains";
    public const POWERPLANT = "power-plant";
    public const SWAMP      = "swamp";
    public const TOWER      = "tower";
    public const URZAS      = "urza’s";

    public const ALL = [
        self::DESERT,
        self::FOREST,
        self::GATE,
        self::ISLAND,
        self::LAIR,
        self::LOCUS,
        self::MINE,
        self::MOUNTAIN,
        self::PLAINS,
        self::POWERPLANT,
        self::SWAMP,
        self::TOWER,
        self::URZAS,
    ];
}