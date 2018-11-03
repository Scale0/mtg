<?php
declare(strict_types = 1);

namespace Mtg\Domain\Model\CardSet;

use Assert\Assertion;

class CardSet
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $code;

    /**
     * @var \DateTime
     */
    private $releaseDate;

    /**
     * @var int
     */
    private $cardCount;

    /**
     * @var string
     */
    private $icon;

    /**
     * @var CardSet
     */
    private $parent;

    /**
     * @return mixed
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
    public function setName($name): CardSet
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     *
     * @return $this
     */
    public function setCode($code): CardSet
    {
        Assertion::betweenLength($code, 3, 4);
        $this->code = $code;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getReleaseDate(): \DateTime
    {
        return $this->releaseDate;
    }

    /**
     * @param mixed $releaseDate
     *
     * @return $this
     */
    public function setReleaseDate($releaseDate): CardSet
    {
        Assertion::date($releaseDate, 'Y-m-d', 'ReleaseDate should be a date (Y-m-d)');
        $this->releaseDate = $releaseDate;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCardCount(): int
    {
        return $this->cardCount;
    }

    /**
     * @param mixed $cardCount
     *
     * @return $this
     */
    public function setCardCount($cardCount): CardSet
    {
        Assertion::integer($cardCount, 'CardCount should be integer');
        $this->cardCount = $cardCount;

        return $this;
    }

    /**
     * @return string
     */
    public function getIcon(): string
    {
        return $this->icon;
    }

    /**
     * @param string $icon
     *
     * @return $this
     */
    public function setIcon($icon): CardSet
    {
        Assertion::url($icon);
        $this->icon = $icon;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getParent(): CardSet
    {
        return $this->parent;
    }

    /**
     * @param mixed $parent
     *
     * @return $this
     */
    public function setParent($parent): CardSet
    {
        Assertion::nullOrIsInstanceOf($parent, self::class);
        $this->parent = $parent;

        return $this;
    }


}