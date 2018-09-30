<?php
/**
 * Created by PhpStorm.
 * User: sjoerddewaard
 * Date: 12-09-18
 * Time: 20:01
 */

namespace Mtg\Domain\Model\Card\Type;

final class Type
{
    public const ARTIFACT = 'Artifact';
    public const CONSPIRACY = 'Conspiracy';
    public const CREATURE = 'Creature';
    public const ENCHANTMENT = "Enchantment";
    public const HOST = 'Host';
    public const INSTANT = "Instant";
    public const LAND = "Land";
    public const PHENOMENON = 'Phenomenon';
    public const PLANE = 'Plane';
    public const PLANESWALKER = 'Planeswalker';
    public const SCHEME = 'Scheme';
    public const SORCERY = 'Sorcery';
    public const TRIBAL = 'Tribal';
    public const VANGUARD = 'Vanguard';

    public const ALL = [
        self::ARTIFACT,
        self::CONSPIRACY,
        self::CREATURE,
        self::ENCHANTMENT,
        self::HOST,
        self::INSTANT,
        self::LAND,
        self::PHENOMENON,
        self::PLANE,
        self::PLANESWALKER,
        self::SCHEME,
        self::SORCERY,
        self::TRIBAL,
        self::VANGUARD
    ];
}