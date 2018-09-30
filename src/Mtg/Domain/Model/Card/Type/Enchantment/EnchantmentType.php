<?php

namespace Mtg\Domain\Model\Card\Type\Enchantment;

class EnchantmentType
{
    public const AURA      = "aura";
    public const CARTOUCHE = "cartouche";
    public const CURSE     = "curse";
    public const SAGA      = "saga";
    public const SHRINE    = "shrine";

    public const ALL = [
        self::AURA,
        self::CARTOUCHE,
        self::CURSE,
        self::SAGA,
        self::SHRINE,
    ];
}