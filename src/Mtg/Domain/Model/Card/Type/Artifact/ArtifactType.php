<?php
declare(strict_types = 1);

namespace Mtg\Domain\Model\Card\Type\Artifact;

class ArtifactType
{
    public const CLUE          = "clue";
    public const CONTRAPTION   = "contraption";
    public const EQUIPMENT     = "equipment";
    public const FORTIFICATION = "fortification";
    public const TREASURE      = "treasure";
    public const VEHICLE       = "vehicle";

    public const ALL = [
        self::CLUE,
        self::CONTRAPTION,
        self::EQUIPMENT,
        self::FORTIFICATION,
        self::TREASURE,
        self::VEHICLE
    ];
}