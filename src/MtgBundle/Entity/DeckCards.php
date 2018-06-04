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
     * @ORM\ManyToOne(targetEntity="MtgBundle\Entity\Deck")
     */
    private $deck;

    /**
     * @ORM\ManyToOne(targetEntity="MtgBundle\Entity\Card")
     */
    private $card;

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
    #endregion


}

