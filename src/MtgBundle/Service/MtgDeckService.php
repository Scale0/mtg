<?php
/**
 * Created by PhpStorm.
 * User: sjoerddewaard
 * Date: 30-05-18
 * Time: 10:22
 */

namespace MtgBundle\Service;

use MtgBundle\Entity\Card;
use MtgBundle\Entity\Deck;
use MtgBundle\Entity\DeckCards;
use MtgBundle\Entity\User;

class MtgDeckService extends MtgService
{
    /**
     * @param $name
     * @param $user
     *
     * @return Deck
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createDeck($name, $user)
    {
        $deck = new Deck();

        $deck
            ->setUser($user)
            ->setName($name);

        $this->em->persist($deck);
        $this->em->flush();

        return $deck;

    }

    /**
     * @param $user
     *
     * @return Deck
     */
    public function getDecks($user)
    {
        return $this->em->getRepository('MtgBundle:Deck')->findBy(['user' => $user]);
    }

    /**
     * @param $id
     * @param User $user
     *
     * @return Deck|null|object
     */
    public function getDeck($id)
    {
        return $this->em->getRepository('MtgBundle:Deck')
            ->findOneBy(['id' => $id]);
    }

    /**
     * @param      $id
     *
     * @return DeckCards[]
     */
    public function getDeckCards($deckId)
    {
        $cards = $this->em->getRepository('MtgBundle:DeckCards')
            ->getCardsOrderedByType($deckId);
        return $cards;
    }

    /**
     * @param Deck $deck
     * @param Card $card
     *
     * @return DeckCards
     */
    public function addCardToDeck(Deck $deck, Card $card)
    {
        $existingDeckCard = $this->em->getRepository('MtgBundle:DeckCards')
            ->findOneBy(['deck' => $deck, 'card' => $card]);

        if ($existingDeckCard) {
            $existingDeckCard->addOne();
            $this->em->persist($existingDeckCard);
            $this->em->flush();
            return $existingDeckCard;
        }

        $DeckCard = new DeckCards();
        $DeckCard->setDeck($deck)
            ->setCard($card);
        $this->em->persist($DeckCard);
        $this->em->flush();

        return $DeckCard;

    }

    public function getConvertedManaByDeck($deck)
    {
        $manaCosts = [];
        $cards = $this->em->getRepository('MtgBundle:DeckCards')
            ->getCardsWithMoreThenZeroCmC($deck);
            ;
        foreach($cards as $card) {
            $key = $card->getCard()->getConvertedManaCosts();
            $manaCosts[$key] =
                (!empty($manaCosts[$key]) ?
                    $manaCosts[$key] + $card->getAmount() :
                    $card->getAmount());
        }

        ksort($manaCosts);
        return $manaCosts;
    }
}