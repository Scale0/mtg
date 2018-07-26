<?php

namespace MtgBundle\Resources\Finals;

final class cardType {
    private static $types = [
        0   => 'unknown',
        1   => 'Artifact',
        2   => 'Creature',
        4   => 'Basic Land',
        8   => 'Card',
        16  => 'Emblem',
        32  => 'Enchantment',
        64  => 'Instant',
        128 => 'Land',
        256 => 'Sorcery',
        512 => 'Planeswalker'
    ];

    public static function getType($id)
    {
        return self::$types[$id];
    }

    /**
     * @param $type
     *
     * @return false|int|string
     */

    public static function getId($type)
    {
        $type = str_replace('Legendary ' ,'', $type);
        return array_search($type, self::$types);
    }
}