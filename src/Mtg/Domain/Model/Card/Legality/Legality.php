<?php
declare(strict_types = 1);

namespace Mtg\Domain\Model\Card\Legality;

class Legality
{

    private const LEGAL = 'legal';
    private const NOT_LEGAL = 'not_legal';

    private const STANDARD = 'standard';
    private const FUTURE = 'future';
    private const FRONTIER = 'frontier';
    private const MODERN = 'modern';
    private const LEGACY = 'legacy';
    private const PAUPER = 'pauper';
    private const VINTAGE = 'vintage';
    private const PENNY = 'penny';
    private const COMMANDER = 'commander';
    private const ONEVONE = '1v1';
    private const DUEL = 'duel';
    private const BRAWL = 'brawl';

    const LEGALITYTYPES = [
        self::STANDARD =>  [self::LEGAL => 1,      self::NOT_LEGAL => 0],
        self::FUTURE   =>  [self::LEGAL => 2,      self::NOT_LEGAL => 0],
        self::FRONTIER =>  [self::LEGAL => 4,      self::NOT_LEGAL => 0],
        self::MODERN   =>  [self::LEGAL => 8,      self::NOT_LEGAL => 0],
        self::LEGACY   =>  [self::LEGAL => 16,     self::NOT_LEGAL => 0],
        self::PAUPER   =>  [self::LEGAL => 32,     self::NOT_LEGAL => 0],
        self::VINTAGE  =>  [self::LEGAL => 64,     self::NOT_LEGAL => 0],
        self::PENNY    =>  [self::LEGAL => 128,    self::NOT_LEGAL => 0],
        self::COMMANDER=>  [self::LEGAL => 256,    self::NOT_LEGAL => 0],
        self::ONEVONE  =>  [self::LEGAL => 512,    self::NOT_LEGAL => 0],
        self::DUEL     =>  [self::LEGAL => 1024,   self::NOT_LEGAL => 0],
        self::BRAWL    =>  [self::LEGAL => 2048,   self::NOT_LEGAL => 0],
    ];

    private $types;

    /**
     * @param $inputString
     *
     * @return Legality
     */
    public static function create($inputString)
    {
        $legality = new self;
        foreach ($inputString as $key => $value) {
            $legality->types += self::LEGALITYTYPES[$key][$value];
        }
        return $legality;
    }

    public function buildFromInt()
    {
        $returnArray = [];
        $types = $this->types;
        foreach (array_reverse(self::LEGALITYTYPES) as $key => $value) {
            if (($types > $value[self::LEGAL] || $types == $value[self::LEGAL]) &&
                    $types / $value[self::LEGAL] > 0) {
                $returnArray[$key] = self::LEGAL;
                $types = $types % $value[self::LEGAL];
            } else {
                $returnArray[$key] = self::NOT_LEGAL;
            }
        }
        return $returnArray;
    }
}