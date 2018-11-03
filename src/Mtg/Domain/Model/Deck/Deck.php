<?php
declare(strict_types = 1);

namespace Mtg\Domain\Model\Deck;

use Assert\Assertion;
use Doctrine\Common\Collections\ArrayCollection;
use Mtg\Domain\Model\Card\Card;

class Deck
{
    /**
     * @var int
     */
    private $id;

    /**
     *
     */
    private $user;

    /**
     * @var string
     */
    private $name;

    /**
     * @var ArrayCollection[]
     */
    private $cards = ArrayCollection::class;

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     *
     * @return $this
     */
    public function setUser($user): Deck
    {
        $this->user = $user;

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
     * @param string $name
     *
     * @return $this
     */
    public function setName(string $name): Deck
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return ArrayCollection[]
     */
    public function getCards(): array
    {
        return $this->cards;
    }

    /**
     * @param Card[] $cards
     *
     * @return $this
     */
    public function setCards($cards): Deck
    {
        Assertion::nullOrIsInstanceOf($cards, ArrayCollection::class);
        $this->cards[] = $cards;
        $this->cards = $cards;

        return $this;
    }

    /**
     * @param Card $card
     *
     * @return $this
     */
    public function addCard($card)
    {
        Assertion::nullOrIsInstanceOf($card, Card::class);
        $this->setCards([$card]);
        return $this;
    }


}