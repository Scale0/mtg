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

    private $mana_cost;

    private $type;

    /**
     * @var ArrayCollection[]
     */
    private $subtype;

    private $type_line;

    private $oracle_text;

    private $flavor_text;

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
        return $this->mana_cost;
    }

    /**
     * @param mixed $mana_cost
     *
     * @return $this
     */
    protected function setManaCost($mana_cost)
    {
        $this->mana_cost = $mana_cost;

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
        return $this->type_line;
    }

    /**
     * @param mixed $type_line
     *
     * @return $this
     */
    protected function setTypeLine($type_line)
    {
        $this->type_line = $type_line;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getOracleText()
    {
        return $this->oracle_text;
    }

    /**
     * @param mixed $oracle_text
     *
     * @return $this
     */
    protected function setOracleText($oracle_text)
    {
        $this->oracle_text = $oracle_text;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFlavorText()
    {
        return $this->flavor_text;
    }

    /**
     * @param mixed $flavor_text
     *
     * @return $this
     */
    protected function setFlavorText($flavor_text)
    {
        $this->flavor_text = $flavor_text;

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