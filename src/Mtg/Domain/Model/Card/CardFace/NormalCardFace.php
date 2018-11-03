<?php
declare(strict_types = 1);

namespace Mtg\Domain\Model\Card\CardFace;

class NormalCardFace extends CardFace
{
    private $power;

    private $toughness;

    /**
     * NormalCardFace constructor.
     *
     * @param $power
     * @param $toughness
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
        $NormalCardFace = new self();
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
     * @return mixed
     */
    public function getPower()
    {
        return $this->power;
    }

    /**
     * @param mixed $power
     *
     * @return $this
     */
    public function setPower($power)
    {
        $this->power = $power;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getToughness()
    {
        return $this->toughness;
    }

    /**
     * @param mixed $toughness
     *
     * @return $this
     */
    public function setToughness($toughness)
    {
        $this->toughness = $toughness;

        return $this;
    }


}