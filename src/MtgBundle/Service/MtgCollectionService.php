<?php

namespace MtgBundle\Service;

use MtgBundle\Entity\Card;
use MtgBundle\Entity\CardCollection;
use Doctrine\ORM\EntityManager;

class MtgCollectionService extends MtgService
{
    private $cardService;
    public function __construct(EntityManager $entityManager,MtgCardService $cardService)
    {
        $this->cardService = $cardService;
        parent::__construct($entityManager);
    }

    public function addCardToCollection($card, $user)
    {
        $collectedCard = new CardCollection();

        $collectedCard->setCard($card);
        $collectedCard->setUser($user);

        $this->em->persist($collectedCard);
        $this->em->flush();

        return $collectedCard;

    }

    public function addArrayToCollection($set, $cards, $user)
    {
        foreach($cards as $cardId) {
            $card = $this->cardService->get($set, intval($cardId));
            $collectedCard = new CardCollection();
            $collectedCard->setUser($user)
                ->setCard($card);
            $this->em->persist($collectedCard);
        }
        $this->em->flush();
    }

    public function get($user)
    {
        $fromCollection = $this->em->getRepository('MtgBundle:CardCollection')->findAll(['user' => $user]);

        return $fromCollection;
    }

    public function getCards($user)
    {
        $fromCollection = $this->get($user);
        foreach($fromCollection as $card) {
            $cards[] = $card->getCard();
        }

        return $cards;
    }

}