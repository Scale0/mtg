<?php

namespace MtgBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $convertedManaCosts;

    /**
     * @ORM\ManyToOne(targetEntity="CardSet")
     */
    private $CardSet;

    /**
     * @ORM\Column(type="string")
     */
    private $rarity;

    /**
     * @ORM\Column(type="json_array")
     */
    private $legality;

    /**
     * @ORM\OneToMany(targetEntity="MtgBundle\Entity\CardFace", mappedBy="card",cascade={"persist"})
     */
    private $faces;

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return integer
     */
    public function getConvertedManaCosts()
    {
        return $this->convertedManaCosts;
    }

    /**
     * @return CardSet
     */
    public function getCardSet()
    {
        return $this->CardSet;
    }

    /**
     * @return string
     */
    public function getRarity()
    {
        return $this->rarity;
    }

    /**
     * @return mixed
     */
    public function getLegality()
    {
        return $this->legality;
    }

    /**
     * @return ArrayCollection|CardFace[]
     */
    public function getFaces()
    {
        return $this->faces;
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
     * @param integer $convertedManaCosts
     *
     * @return $this
     */
    public function setConvertedManaCosts($convertedManaCosts)
    {
        $this->convertedManaCosts = $convertedManaCosts;

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
     * @param $legality
     *
     * @return $this
     */
    public function setLegality($legality)
    {
        $this->legality = $legality;

        return $this;
    }

    /**
     * @param CardFace $cardFace
     *
     * @return $this
     */
    public function addCardFace(CardFace $cardFace)
    {
        $this->faces[] = $cardFace;

        return $this;
    }


    #endregion

}
