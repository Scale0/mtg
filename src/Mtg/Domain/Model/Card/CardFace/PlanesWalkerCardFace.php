<?php
declare(strict_types = 1);

namespace Mtg\Domain\Model\Card\CardFace;

class PlanesWalkerCardFace extends CardFace
{
    private $loyalty;

    /**
     * PlanesWalkerCardFace constructor.
     *
     * @param $loyalty
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
        $loyalty)
    {

        $PlanesWalkerCardFace = new self();
        $PlanesWalkerCardFace
            ->setName($name)
            ->setImgUrl($imgUrl)
            ->setManaCost($mana_cost)
            ->setType($type)
            ->setSubtype($subtype)
            ->setTypeLine($type_line)
            ->setOracleText($oracle_text)
            ->setFlavorText($flavor_text)
            ->setColors($colors)
            ->setloyalty($loyalty);

        return $PlanesWalkerCardFace;
    }

    /**
     * @return mixed
     */
    public function getLoyalty()
    {
        return $this->loyalty;
    }

    /**
     * @param mixed $loyalty
     *
     * @return $this
     */
    public function setLoyalty($loyalty)
    {
        $this->loyalty = $loyalty;

        return $this;
    }

}