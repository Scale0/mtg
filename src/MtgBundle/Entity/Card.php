<?php

namespace MtgBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Card
 *
 * @ORM\Table(name="card")
 * @ORM\Entity(repositoryClass="MtgBundle\Repository\CardRepository")
 */
class Card
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $collectionId;

    /**
     * @ORM\Column(type="string")
     */
    private $imgUrl;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $type_line;

    /**
     * @ORM\Column(type="string")
     */
    private $type;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $subtype;
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $oracle_text;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $flavor_text;

    /**
     * @ORM\Column(type="string")
     */
    private $mana_cost;

    /**
     * @ORM\ManyToOne(targetEntity="CardSet")
     */
    private $CardSet;

    /**
     * @ORM\Column(type="string")
     */
    private $rarity;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $power;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $toughness;

    /**
     * @ORM\Column(type="json_array")
     */
    private $colors;

    #region getters
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getCollectionId()
    {
        return $this->collectionId;
    }

    /**
     * @return mixed
     */
    public function getImgUrl()
    {
        return $this->imgUrl;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getTypeLine()
    {
        return $this->type_line;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getSubtype()
    {
        return $this->subtype;
    }


    /**
     * @return mixed
     */
    public function getOracleText()
    {
        return $this->oracle_text;
    }

    /**
     * @return mixed
     */
    public function getFlavorText()
    {
        return $this->flavor_text;
    }

    /**
     * @return mixed
     */
    public function getManaCost()
    {
        return $this->mana_cost;
    }

    /**
     * @return mixed
     */
    public function getCardSet()
    {
        return $this->CardSet;
    }

    /**
     * @return mixed
     */
    public function getRarity()
    {
        return $this->rarity;
    }

    /**
     * @return mixed
     */
    public function getPower()
    {
        return $this->power;
    }

    /**
     * @return mixed
     */
    public function getToughness()
    {
        return $this->toughness;
    }

    /**
     * @return mixed
     */
    public function getColors()
    {
        return $this->colors;
    }

    #endregion

    #region setters
    /**
     * @param mixed $collectionId
     *
     * @return $this
     */
    public function setCollectionId($collectionId)
    {
        $this->collectionId = $collectionId;

        return $this;
    }

    /**
     * @param mixed $imgUrl
     *
     * @return $this
     */
    public function setImgUrl($imgUrl)
    {
        $this->imgUrl = $imgUrl;

        return $this;
    }

    /**
     * @param mixed $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param mixed $type_line
     *
     * @return $this
     */
    public function setTypeLine($type_line)
    {
        $this->type_line = $type_line;

        $type = explode(" — ", $type_line);
        $this->type = $type[0];
        $this->subtype = !empty($type[1]) ? $type[1] : null;

        return $this;
    }

    /**
     * @param mixed $oracle_text
     *
     * @return $this
     */
    public function setOracleText($oracle_text)
    {
        $this->oracle_text = $oracle_text;

        return $this;
    }

    /**
     * @param mixed $flavor_text
     *
     * @return $this
     */
    public function setFlavorText($flavor_text)
    {
        $this->flavor_text = $flavor_text;

        return $this;
    }

    /**
     * @param mixed $mana_cost
     *
     * @return $this
     */
    public function setManaCost($mana_cost)
    {
        $this->mana_cost = $mana_cost;

        return $this;
    }

    /**
     * @param CardSet $CardSet
     *
     * @return $this
     */
    public function setCardSet(CardSet $CardSet)
    {
        $this->CardSet = $CardSet;

        return $this;
    }

    /**
     * @param mixed $rarity
     *
     * @return $this
     */
    public function setRarity($rarity)
    {
        $this->rarity = $rarity;

        return $this;
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
     * @param mixed $toughness
     *
     * @return $this
     */
    public function setToughness($toughness)
    {
        $this->toughness = $toughness;

        return $this;
    }

    /**
     * @param mixed $colors
     *
     * @return $this
     */
    public function setColors($colors)
    {
        $this->colors = $colors;

        return $this;
    }


    #endregion

}

