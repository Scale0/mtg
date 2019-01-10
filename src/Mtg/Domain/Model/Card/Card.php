<?php
declare(strict_types = 1);

namespace Mtg\Domain\Model\Card;

use Assert\Assertion;
use Doctrine\Common\Collections\ArrayCollection;
use Mtg\Domain\Model\Card\CardFace\CardFace;
use Mtg\Domain\Model\Card\Legality\Legality;
use Mtg\Domain\Model\Card\Rarity\Rarity;
use Mtg\Domain\Model\CardSet\CardSet;

class Card
{

    /**
     * @var int $collectionNumber
     */
    private $collectionNumber;

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var CardSet $set
     */
    private $set;

    /**
     * @var Rarity $rarity
     */
    private $rarity;

    /**
     * @var int $convertedManaCost
     */
    private $convertedManaCost;

    /**
     * @var Legality $legality
     */
    private $legality;

    /** @var ArrayCollection $faces` */
    private $faces;

    /**
     * @param         $collectionNumber
     * @param         $name
     * @param CardSet $set
     * @param         $rarity
     * @param         $convertedManaCost
     * @param         $legality
     *
     * @return Card
     */
    public static function create($collectionNumber, $name, CardSet $set, $rarity, $convertedManaCost, $legality)
    {
        $card = new self();
        Assertion::nullOrInArray($rarity, Rarity::ALL);

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
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     *
     * @return $this
     */
    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return CardSet
     */
    public function getSet(): CardSet
    {
        return $this->set;
    }

    /**
     * @param CardSet $set
     *
     * @return $this
     */
    public function setSet(CardSet $set): self
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
     * @param Rarity $rarity
     *
     * @return $this
     */
    public function setRarity($rarity): self
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
    public function setConvertedManaCost($convertedManaCost): self
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
    public function setLegality($legality): self
    {
        $this->legality = Legality::create($legality);

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
     * @param CardFace $face
     *
     * @return $this
     */
    public function addFace(CardFace $face): self
    {
        Assertion::nullOrIsInstanceOf($face, CardFace::class);
        if ($this->faces->count() <= 1) {
            $this->faces->add($face);
        }

        return $this;
    }

}