<?php
declare(strict_types = 1);

namespace Mtg\Domain\Model\Card\CardFace;

class NormalCardFace extends CardFace
{
    /**
     * @var int $power
     */
    private $power;

    /**
     * @var int $toughness
     */
    private $toughness;

    /**
     * @param $name
     * @param $imgUrl
     * @param $mana_cost
     * @param $type
     * @param $subtype
     * @param $type_line
     * @param $oracle_text
     * @param $flavor_text
     * @param $colors
     * @param $power
     * @param $toughness
     *
     * @return NormalCardFace
     */
    public static function create(
        $name,
        $imgUrl,
        $mana_cost,
        $type,
        $subtype,
        $type_line,
        $oracle_text,
        $flavor_text,
        $colors,
        $power,
        $toughness)
    {
        $NormalCardFace = new self;
        $NormalCardFace
            ->setName($name)
            ->setImgUrl($imgUrl)
            ->setManaCost($mana_cost)
            ->setType($type)
            ->setSubtype($subtype)
            ->setTypeLine($type_line)
            ->setOracleText($oracle_text)
            ->setFlavorText($flavor_text)
            ->setColors($colors)
            ->setPower($power)
            ->setToughness($toughness);

        return $NormalCardFace;
    }

    /**
     * @return int
     */
    public function getPower()
    {
        return $this->power;
    }

    /**
     * @param int $power
     *
     * @return $this
     */
    public function setPower($power)
    {
        $this->power = $power;

        return $this;
    }

    /**
     * @return int
     */
    public function getToughness()
    {
        return $this->toughness;
    }

    /**
     * @param int $toughness
     *
     * @return $this
     */
    public function setToughness($toughness)
    {
        $this->toughness = $toughness;

        return $this;
    }


}