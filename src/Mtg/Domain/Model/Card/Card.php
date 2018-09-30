<?php

namespace Mtg\Domain\Model\Card;

use Doctrine\Common\Collections\ArrayCollection;
use Mtg\Domain\Model\Card\CardFace\CardFace;

class Card
{

    private $collectionNumber;

    private $name;

    private $set;

    private $rarity;

    private $convertedManaCost;

    private $legality;

    /** @var ArrayCollection */
    private $faces;
    /**
     * Card constructor.
     *
     * @param $collectionNumber
     * @param $name
     * @param $set
     * @param $rarity
     * @param $convertedManaCost
     * @param $legality
     */
    public static function create($collectionNumber, $name, $set, $rarity, $convertedManaCost, $legality)
    {
        $card = new self();
        $card->faces = new ArrayCollection();
        $card
            ->setCollectionNumber($collectionNumber)
            ->setName($name)
            ->setSet($set)
            ->setRarity($rarity)
            ->setConvertedManaCost($convertedManaCost)
            ->setLegality($legality);

        return $card;

    }

    /**
     * @return mixed
     */
    public function getCollectionNumber()
    {
        return $this->collectionNumber;
    }

    /**
     * @param mixed $collectionNumber
     *
     * @return $this
     */
    public function setCollectionNumber($collectionNumber)
    {
        $this->collectionNumber = $collectionNumber;

        return $this;
    }

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
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSet()
    {
        return $this->set;
    }

    /**
     * @param mixed $set
     *
     * @return $this
     */
    public function setSet($set)
    {
        $this->set = $set;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRarity()
    {
        return $this->rarity;
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
     * @return mixed
     */
    public function getConvertedManaCost()
    {
        return $this->convertedManaCost;
    }

    /**
     * @param mixed $convertedManaCost
     *
     * @return $this
     */
    public function setConvertedManaCost($convertedManaCost)
    {
        $this->convertedManaCost = $convertedManaCost;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLegality()
    {
        return $this->legality;
    }

    /**
     * @param mixed $legality
     *
     * @return $this
     */
    public function setLegality($legality)
    {
        $this->legality = $legality;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFaces()
    {
        return $this->faces;
    }

    /**
     * @param CardFace $faces
     *
     * @return $this
     */
    public function addFace(CardFace $face)
    {
        if ($face instanceof CardFace && count($this->faces) <= 1) {
            $this->faces[] = $face;
        }

        return $this;
    }


}