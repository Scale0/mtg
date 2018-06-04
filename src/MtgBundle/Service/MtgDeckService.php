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
     * @param      $id
     * @param User $user
     *
     * @return Deck|null|object
     */
    public function getDeck($id, User $user)
    {
        return $this->em->getRepository('MtgBundle:Deck')->findOneBy(['id' => $id, 'user' => $user]);
    }

    /**
     * @param Deck $deck
     * @param Card $card
     *
     * @return DeckCards
     */
    public function addCardToDeck(Deck $deck, Card $card)
    {
        $deckCard = new DeckCards();
        $deckCard
            ->setCard($card)
            ->setDeck($deck);

        $this->em->persist($deckCard);
        $this->em->flush();

        return $deckCard;

    }
}