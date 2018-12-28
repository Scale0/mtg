<?php
declare(strict_types = 1);

namespace Mtg\Domain\Model\Card\CardFace;

use Assert\Assertion;
use Doctrine\Common\Collections\ArrayCollection;
use Mtg\Domain\Model\Card\Type\Type;

abstract class CardFace
{
    private $name;

    private $imgUrl;

    private $manaCost;

    private $type;

    /**
     * @var ArrayCollection[]
     */
    private $subtype;

    private $typeLine;

    private $oracleText;

    private $flavorText;

    private $colors;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     *
     * @return $this
     */
    protected function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getImgUrl()
    {
        return $this->imgUrl;
    }

    /**
     * @param mixed $imgUrl
     *
     * @return $this
     */
    protected function setImgUrl($imgUrl)
    {
        $this->imgUrl = $imgUrl;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getManaCost()
    {
        return $this->manaCost;
    }

    /**
     * @param $manaCost
     *
     * @return $this
     */
    protected function setManaCost($manaCost)
    {
        $this->manaCost = $manaCost;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     *
     * @return $this
     */
    protected function setType($type)
    {
        Assertion::nullOrInArray($type, Type::ALL);
        $this->type = $type;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSubtype()
    {
        return $this->subtype;
    }

    /**
     * @param mixed $subtype
     *
     * @return $this
     */
    protected function setSubtype($subtype)
    {
        $this->subtype = $subtype;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTypeLine()
    {
        return $this->typeLine;
    }

    /**
     * @param mixed $typeLine
     *
     * @return $this
     */
    protected function setTypeLine($typeLine)
    {
        $this->typeLine = $typeLine;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getOracleText()
    {
        return $this->oracleText;
    }

    /**
     * @param mixed $oracleText
     *
     * @return $this
     */
    protected function setOracleText($oracleText)
    {
        $this->oracleText = $oracleText;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFlavorText()
    {
        return $this->flavorText;
    }

    /**
     * @param $flavorText
     *
     * @return $this
     */
    protected function setFlavorText($flavorText)
    {
        $this->flavorText = $flavorText;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getColors()
    {
        return $this->colors;
    }

    /**
     * @param mixed $colors
     *
     * @return $this
     */
    protected function setColors($colors)
    {
        $this->colors = $colors;

        return $this;
    }

}