<?php

namespace MtgBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use MtgBundle\Resources\Finals\cardType;

/**
 * CardFace
 *
 * @ORM\Table(name="card_face")
 * @ORM\Entity(repositoryClass="MtgBundle\Repository\CardFaceRepository")
 */
class CardFace
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
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $imgUrl;

    /**
     * @ORM\Column(type="string")
     */
    private $mana_cost;

    /**
     * @ORM\Column(type="integer")
     */
    private $type;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $subtype;

    /**
     * @ORM\Column(type="string")
     */
    private $type_line;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $oracle_text;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $flavor_text;

    /**
     * @ORM\Column(type="json_array")
     */
    private $colors;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $power;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $toughness;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $loyalty;

    /**
     * @ORM\ManyToOne(targetEntity="MtgBundle\Entity\Card", inversedBy="faces")
     */
    private $card;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
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
    public function getManaCost()
    {
        return $this->mana_cost;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return cardType::getType($this->type);
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

    public function getFlavorText()
    {
        return $this->flavor_text;
    }

    /**
     * @return mixed
     */
    public function getColors()
    {
        return $this->colors;
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
    public function getLoyalty()
    {
        return $this->loyalty;
    }

    /**
     * @param string $imgUrl
     *
     * @return $this
     */
    public function setImgUrl($imgUrl)
    {
        $this->imgUrl = strstr($imgUrl, "?", true);

        return $this;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

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
     * @param mixed $type_line
     *
     * @return $this
     */
    public function setTypeLine($type_line)
    {
        $this->type_line = $type_line;

        $type = explode(" — ", $type_line);

        $this->setSubtype(!empty($type[1]) ? $type[1] : null);
        $type = cardType::getId($type[0]);
        $this->type = $type;

        return $this;
    }

    /**
     * @param mixed $subtype
     *
     * @return $this
     */
    public function setSubtype($subtype)
    {
        $this->subtype = $subtype;

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
     * @param $flavor_text
     *
     * @return $this
     */
    public function setFlavorText($flavor_text)
    {
        $this->flavor_text = $flavor_text;

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
     * @param mixed $loyalty
     *
     * @return $this
     */
    public function setLoyalty($loyalty)
    {
        $this->loyalty = $loyalty;

        return $this;
    }

    /**
     * @param Card $card
     *
     * @return $this
     */
    public function setCard(Card $card)
    {
        $this->card = $card;

        return $this;
    }


}

