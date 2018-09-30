<?php

namespace Mtg\Domain\Model\Card\Type\Creature;

class CreatureType
{
    public const ADVISOR        = "advisor";
    public const AETHERBORN     = "aetherborn";
    public const ALLY           = "ally";
    public const ANGEL          = "angel";
    public const ANTELOPE       = "antelope";
    public const APE            = "ape";
    public const ARCHER         = "archer";
    public const ARCHON         = "archon";
    public const ARTIFICER      = "artificer";
    public const ASSASSIN       = "assassin";
    public const ASSEMBLYWORKER = "assembly-worker";
    public const ATOG           = "atog";
    public const AUROCHS        = "aurochs";
    public const AVATAR         = "avatar";
    public const AZRA           = "azra";
    public const BADGER         = "badger";
    public const BARBARIAN      = "barbarian";
    public const BASILISK       = "basilisk";
    public const BAT            = "bat";
    public const BEAR           = "bear";
    public const BEAST          = "beast";
    public const BEEBLE         = "beeble";
    public const BERSERKER      = "berserker";
    public const BIRD           = "bird";
    public const BLINKMOTH      = "blinkmoth";
    public const BOAR           = "boar";
    public const BRINGER        = "bringer";
    public const BRUSHWAGG      = "brushwagg";
    public const CAMARID        = "camarid";
    public const CAMEL          = "camel";
    public const CARIBOU        = "caribou";
    public const CARRIER        = "carrier";
    public const CAT            = "cat";
    public const CENTAUR        = "centaur";
    public const CEPHALID       = "cephalid";
    public const CHIMERA        = "chimera";
    public const CITIZEN        = "citizen";
    public const CLERIC         = "cleric";
    public const COCKATRICE     = "cockatrice";
    public const CONSTRUCT      = "construct";
    public const COWARD         = "coward";
    public const CRAB           = "crab";
    public const CROCODILE      = "crocodile";
    public const CYCLOPS        = "cyclops";
    public const DAUTHI         = "dauthi";
    public const DEMON          = "demon";
    public const DESERTER       = "deserter";
    public const DEVIL          = "devil";
    public const DINOSAUR       = "dinosaur";
    public const DJINN          = "djinn";
    public const DRAGON         = "dragon";
    public const DRAKE          = "drake";
    public const DREADNOUGHT    = "dreadnought";
    public const DRONE          = "drone";
    public const DRUID          = "druid";
    public const DRYAD          = "dryad";
    public const DWARF          = "dwarf";
    public const EFREET         = "efreet";
    public const EGG            = "egg";
    public const ELDER          = "elder";
    public const ELDRAZI        = "eldrazi";
    public const ELEMENTAL      = "elemental";
    public const ELEPHANT       = "elephant";
    public const ELF            = "elf";
    public const ELK            = "elk";
    public const EYE            = "eye";
    public const FAERIE         = "faerie";
    public const FERRET         = "ferret";
    public const FISH           = "fish";
    public const FLAGBEARER     = "flagbearer";
    public const FOX            = "fox";
    public const FROG           = "frog";
    public const FUNGUS         = "fungus";
    public const GARGOYLE       = "gargoyle";
    public const GERM           = "germ";
    public const GIANT          = "giant";
    public const GNOME          = "gnome";
    public const GOAT           = "goat";
    public const GOBLIN         = "goblin";
    public const GOD            = "god";
    public const GOLEM          = "golem";
    public const GORGON         = "gorgon";
    public const GRAVEBORN      = "graveborn";
    public const GREMLIN        = "gremlin";
    public const GRIFFIN        = "griffin";
    public const HAG            = "hag";
    public const HARPY          = "harpy";
    public const HEAD           = "head";
    public const HELLION        = "hellion";
    public const HIPPO          = "hippo";
    public const HIPPOGRIFF     = "hippogriff";
    public const HOMARID        = "homarid";
    public const HOMUNCULUS     = "homunculus";
    public const HORNET         = "hornet";
    public const HORROR         = "horror";
    public const HORSE          = "horse";
    public const HOUND          = "hound";
    public const HUMAN          = "human";
    public const HYDRA          = "hydra";
    public const HYENA          = "hyena";
    public const ILLUSION       = "illusion";
    public const IMP            = "imp";
    public const INCARNATION    = "incarnation";
    public const INSECT         = "insect";
    public const JACKAL         = "jackal";
    public const JELLYFISH      = "jellyfish";
    public const JUGGERNAUT     = "juggernaut";
    public const KAVU           = "kavu";
    public const KIRIN          = "kirin";
    public const KITHKIN        = "kithkin";
    public const KNIGHT         = "knight";
    public const KOBOLD         = "kobold";
    public const KOR            = "kor";
    public const KRAKEN         = "kraken";
    public const LAMIA          = "lamia";
    public const LAMMASU        = "lammasu";
    public const LEECH          = "leech";
    public const LEVIATHAN      = "leviathan";
    public const LHURGOYF       = "lhurgoyf";
    public const LICID          = "licid";
    public const LIZARD         = "lizard";
    public const MANTICORE      = "manticore";
    public const MASTICORE      = "masticore";
    public const MERCENARY      = "mercenary";
    public const MERFOLK        = "merfolk";
    public const METATHRAN      = "metathran";
    public const MINION         = "minion";
    public const MINOTAUR       = "minotaur";
    public const MOLE           = "mole";
    public const MONGER         = "monger";
    public const MONGOOSE       = "mongoose";
    public const MONK           = "monk";
    public const MONKEY         = "monkey";
    public const MOONFOLK       = "moonfolk";
    public const MUTANT         = "mutant";
    public const MYR            = "myr";
    public const MYSTIC         = "mystic";
    public const NAGA           = "naga";
    public const NAUTILUS       = "nautilus";
    public const NEPHILIM       = "nephilim";
    public const NIGHTMARE      = "nightmare";
    public const NIGHTSTALKER   = "nightstalker";
    public const NINJA          = "ninja";
    public const NOGGLE         = "noggle";
    public const NOMAD          = "nomad";
    public const NYMPH          = "nymph";
    public const OCTOPUS        = "octopus";
    public const OGRE           = "ogre";
    public const OOZE           = "ooze";
    public const ORB            = "orb";
    public const ORC            = "orc";
    public const ORGG           = "orgg";
    public const OUPHE          = "ouphe";
    public const OX             = "ox";
    public const OYSTER         = "oyster";
    public const PANGOLIN       = "pangolin";
    public const PEGASUS        = "pegasus";
    public const PENTAVITE      = "pentavite";
    public const PEST           = "pest";
    public const PHELDDAGRIF    = "phelddagrif";
    public const PHOENIX        = "phoenix";
    public const PILOT          = "pilot";
    public const PINCHER        = "pincher";
    public const PIRATE         = "pirate";
    public const PLANT          = "plant";
    public const PRAETOR        = "praetor";
    public const PRISM          = "prism";
    public const PROCESSOR      = "processor";
    public const RABBIT         = "rabbit";
    public const RAT            = "rat";
    public const REBEL          = "rebel";
    public const REVELER        = "reveler";
    public const RHINO          = "rhino";
    public const RIGGER         = "rigger";
    public const ROGUE          = "rogue";
    public const RUKH           = "rukh";
    public const SABLE          = "sable";
    public const SALAMANDER     = "salamander";
    public const SAMURAI        = "samurai";
    public const SAND           = "sand";
    public const SAPROLING      = "saproling";
    public const SATYR          = "satyr";
    public const SCARECROW      = "scarecrow";
    public const SCION          = "scion";
    public const SCORPION       = "scorpion";
    public const SCOUT          = "scout";
    public const SERF           = "serf";
    public const SERPENT        = "serpent";
    public const SERVO          = "servo";
    public const SHADE          = "shade";
    public const SHAMAN         = "shaman";
    public const SHAPESHIFTER   = "shapeshifter";
    public const SHEEP          = "sheep";
    public const SIREN          = "siren";
    public const SKELETON       = "skeleton";
    public const SLITH          = "slith";
    public const SLIVER         = "sliver";
    public const SLUG           = "slug";
    public const SNAKE          = "snake";
    public const SOLDIER        = "soldier";
    public const SOLTARI        = "soltari";
    public const SPAWN          = "spawn";
    public const SPECTER        = "specter";
    public const SPELLSHAPER    = "spellshaper";
    public const SPHINX         = "sphinx";
    public const SPIDER         = "spider";
    public const SPIKE          = "spike";
    public const SPIRIT         = "spirit";
    public const SPLINTER       = "splinter";
    public const SPONGE         = "sponge";
    public const SQUID          = "squid";
    public const SQUIRREL       = "squirrel";
    public const STARFISH       = "starfish";
    public const SURRAKAR       = "surrakar";
    public const SURVIVOR       = "survivor";
    public const TETRAVITE      = "tetravite";
    public const THALAKOS       = "thalakos";
    public const THOPTER        = "thopter";
    public const THRULL         = "thrull";
    public const TREEFOLK       = "treefolk";
    public const TRILOBITE      = "trilobite";
    public const TRISKELAVITE   = "triskelavite";
    public const TROLL          = "troll";
    public const TURTLE         = "turtle";
    public const UNICORN        = "unicorn";
    public const VAMPIRE        = "vampire";
    public const VEDALKEN       = "vedalken";
    public const VIASHINO       = "viashino";
    public const VOLVER         = "volver";
    public const WALL           = "wall";
    public const WARRIOR        = "warrior";
    public const WASP           = "wasp";
    public const WEIRD          = "weird";
    public const WEREWOLF       = "werewolf";
    public const WHALE          = "whale";
    public const WIZARD         = "wizard";
    public const WOLF           = "wolf";
    public const WOLVERINE      = "wolverine";
    public const WOMBAT         = "wombat";
    public const WORM           = "worm";
    public const WRAITH         = "wraith";
    public const WURM           = "wurm";
    public const YETI           = "yeti";
    public const ZOMBIE         = "zombie";
    public const ZUBERA         = "Zubera";

    public const ALL = [
        self::ADVISOR,
        self::AETHERBORN,
        self::ALLY,
        self::ANGEL,
        self::ANTELOPE,
        self::APE,
        self::ARCHER,
        self::ARCHON,
        self::ARTIFICER,
        self::ASSASSIN,
        self::ASSEMBLYWORKER,
        self::ATOG,
        self::AUROCHS,
        self::AVATAR,
        self::AZRA,
        self::BADGER,
        self::BARBARIAN,
        self::BASILISK,
        self::BAT,
        self::BEAR,
        self::BEAST,
        self::BEEBLE,
        self::BERSERKER,
        self::BIRD,
        self::BLINKMOTH,
        self::BOAR,
        self::BRINGER,
        self::BRUSHWAGG,
        self::CAMARID,
        self::CAMEL,
        self::CARIBOU,
        self::CARRIER,
        self::CAT,
        self::CENTAUR,
        self::CEPHALID,
        self::CHIMERA,
        self::CITIZEN,
        self::CLERIC,
        self::COCKATRICE,
        self::CONSTRUCT,
        self::COWARD,
        self::CRAB,
        self::CROCODILE,
        self::CYCLOPS,
        self::DAUTHI,
        self::DEMON,
        self::DESERTER,
        self::DEVIL,
        self::DINOSAUR,
        self::DJINN,
        self::DRAGON,
        self::DRAKE,
        self::DREADNOUGHT,
        self::DRONE,
        self::DRUID,
        self::DRYAD,
        self::DWARF,
        self::EFREET,
        self::EGG,
        self::ELDER,
        self::ELDRAZI,
        self::ELEMENTAL,
        self::ELEPHANT,
        self::ELF,
        self::ELK,
        self::EYE,
        self::FAERIE,
        self::FERRET,
        self::FISH,
        self::FLAGBEARER,
        self::FOX,
        self::FROG,
        self::FUNGUS,
        self::GARGOYLE,
        self::GERM,
        self::GIANT,
        self::GNOME,
        self::GOAT,
        self::GOBLIN,
        self::GOD,
        self::GOLEM,
        self::GORGON,
        self::GRAVEBORN,
        self::GREMLIN,
        self::GRIFFIN,
        self::HAG,
        self::HARPY,
        self::HEAD,
        self::HELLION,
        self::HIPPO,
        self::HIPPOGRIFF,
        self::HOMARID,
        self::HOMUNCULUS,
        self::HORNET,
        self::HORROR,
        self::HORSE,
        self::HOUND,
        self::HUMAN,
        self::HYDRA,
        self::HYENA,
        self::ILLUSION,
        self::IMP,
        self::INCARNATION,
        self::INSECT,
        self::JACKAL,
        self::JELLYFISH,
        self::JUGGERNAUT,
        self::KAVU,
        self::KIRIN,
        self::KITHKIN,
        self::KNIGHT,
        self::KOBOLD,
        self::KOR,
        self::KRAKEN,
        self::LAMIA,
        self::LAMMASU,
        self::LEECH,
        self::LEVIATHAN,
        self::LHURGOYF,
        self::LICID,
        self::LIZARD,
        self::MANTICORE,
        self::MASTICORE,
        self::MERCENARY,
        self::MERFOLK,
        self::METATHRAN,
        self::MINION,
        self::MINOTAUR,
        self::MOLE,
        self::MONGER,
        self::MONGOOSE,
        self::MONK,
        self::MONKEY,
        self::MOONFOLK,
        self::MUTANT,
        self::MYR,
        self::MYSTIC,
        self::NAGA,
        self::NAUTILUS,
        self::NEPHILIM,
        self::NIGHTMARE,
        self::NIGHTSTALKER,
        self::NINJA,
        self::NOGGLE,
        self::NOMAD,
        self::NYMPH,
        self::OCTOPUS,
        self::OGRE,
        self::OOZE,
        self::ORB,
        self::ORC,
        self::ORGG,
        self::OUPHE,
        self::OX,
        self::OYSTER,
        self::PANGOLIN,
        self::PEGASUS,
        self::PENTAVITE,
        self::PEST,
        self::PHELDDAGRIF,
        self::PHOENIX,
        self::PILOT,
        self::PINCHER,
        self::PIRATE,
        self::PLANT,
        self::PRAETOR,
        self::PRISM,
        self::PROCESSOR,
        self::RABBIT,
        self::RAT,
        self::REBEL,
        self::REVELER,
        self::RHINO,
        self::RIGGER,
        self::ROGUE,
        self::RUKH,
        self::SABLE,
        self::SALAMANDER,
        self::SAMURAI,
        self::SAND,
        self::SAPROLING,
        self::SATYR,
        self::SCARECROW,
        self::SCION,
        self::SCORPION,
        self::SCOUT,
        self::SERF,
        self::SERPENT,
        self::SERVO,
        self::SHADE,
        self::SHAMAN,
        self::SHAPESHIFTER,
        self::SHEEP,
        self::SIREN,
        self::SKELETON,
        self::SLITH,
        self::SLIVER,
        self::SLUG,
        self::SNAKE,
        self::SOLDIER,
        self::SOLTARI,
        self::SPAWN,
        self::SPECTER,
        self::SPELLSHAPER,
        self::SPHINX,
        self::SPIDER,
        self::SPIKE,
        self::SPIRIT,
        self::SPLINTER,
        self::SPONGE,
        self::SQUID,
        self::SQUIRREL,
        self::STARFISH,
        self::SURRAKAR,
        self::SURVIVOR,
        self::TETRAVITE,
        self::THALAKOS,
        self::THOPTER,
        self::THRULL,
        self::TREEFOLK,
        self::TRILOBITE,
        self::TRISKELAVITE,
        self::TROLL,
        self::TURTLE,
        self::UNICORN,
        self::VAMPIRE,
        self::VEDALKEN,
        self::VIASHINO,
        self::VOLVER,
        self::WALL,
        self::WARRIOR,
        self::WASP,
        self::WEIRD,
        self::WEREWOLF,
        self::WHALE,
        self::WIZARD,
        self::WOLF,
        self::WOLVERINE,
        self::WOMBAT,
        self::WORM,
        self::WRAITH,
        self::WURM,
        self::YETI,
        self::ZOMBIE,
        self::ZUBERA,
    ];
}