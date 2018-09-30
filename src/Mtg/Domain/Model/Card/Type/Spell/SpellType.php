<?php

namespace Mtg\Domain\Model\Card\Type\Spell;

class SpellType
{
    public const ARCANE = "arcane";
    public const TRAP   = "trap";

    public const ALL = [
        self::ARCANE,
        self::TRAP,
    ];
}