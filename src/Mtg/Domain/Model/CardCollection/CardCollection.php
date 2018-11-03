<?php
declare(strict_types = 1);

namespace Mtg\Domain\Model\CardCollection;

use Mtg\Domain\Model\Card\Card;

class CardCollection
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var
     */
    private $user;

    /**
     * @var Card
     */
    private $card;

    /**
     * @var int
     */
    private $amount = 1;

    public function getId()
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
    public function setUser($user): Card
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Card
     */
    public function getCard(): Card
    {
        return $this->card;
    }

    /**
     * @param Card $card
     *
     * @return $this
     */
    public function setCard(Card $card): Card
    {
        $this->card = $card;

        return $this;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     *
     * @return $this
     */
    public function setAmount(int $amount): CardCollection
    {
        $this->amount = $amount;

        return $this;
    }

    public function addOne()
    {
        $this->amount++;
    }

    public function removeOne()
    {
        $this->amount--;
    }
}