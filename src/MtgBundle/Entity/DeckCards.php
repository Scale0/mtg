<?php

namespace MtgBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DeckCards
 *
 * @ORM\Table(name="deck_cards")
 * @ORM\Entity(repositoryClass="MtgBundle\Repository\DeckCardsRepository")
 */
class DeckCards
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
     * @ORM\ManyToOne(targetEntity="MtgBundle\Entity\Deck", inversedBy="DeckCards")
     */
    private $deck;

    /**
     * @ORM\ManyToOne(targetEntity="MtgBundle\Entity\Card")
     */
    private $card;

    /**
     * @ORM\Column(type="integer")
     */
    private $amount = 1;

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
     * @return Deck
     */
    public function getDeck()
    {
        return $this->deck;
    }

    /**
     * @return Card
     */
    public function getCard()
    {
        return $this->card;
    }

    public function getAmount()
    {
        return $this->amount;
    }
    #endregion

    #region setters


    /**
     * @param mixed $deck
     *
     * @return $this
     */
    public function setDeck($deck)
    {
        $this->deck = $deck;

        return $this;
    }

    /**
     * @param mixed $card
     *
     * @return $this
     */
    public function setCard($card)
    {
        $this->card = $card;

        return $this;
    }

    /**
     * @param int $limit
     *
     * @return $this
     */
    public function addOne($limit = 4)
    {
        if ($this->amount < $limit) {
            $this->amount++;
        }
        return $this;
    }
    #endregion


}

