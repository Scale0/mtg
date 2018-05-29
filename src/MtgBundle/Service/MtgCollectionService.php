<?php

namespace MtgBundle\Service;

use MtgBundle\Entity\Card;
use MtgBundle\Entity\CardCollection;
use Doctrine\ORM\EntityManager;
use MtgBundle\Entity\User;

class MtgCollectionService extends MtgService
{
    private $cardService;
    public function __construct(EntityManager $entityManager,MtgCardService $cardService)
    {
        $this->cardService = $cardService;
        parent::__construct($entityManager);
    }

    /**
     * @param $id
     *
     * @return CardCollection|null
     */
    public function get($id)
    {
        return $this->em->getRepository('MtgBundle:CardCollection')->find($id);
    }

    /**
     * @param Card $card
     * @param User $user
     *
     * @return CardCollection
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function addCardToCollection(Card $card, User $user)
    {
        $collectedCard = new CardCollection();

        $collectedCard->setCard($card);
        $collectedCard->setUser($user);

        $this->em->persist($collectedCard);
        $this->em->flush();

        return $collectedCard;

    }

    /**
     * @param User $user
     * @param Card $card
     *
     * @return array|CardCollection[]
     */
    public function getCountByUserAndCard(User $user, Card $card)
    {
        $cards = $this->em->getRepository('MtgBundle:CardCollection')->findBy(['user' => $user, 'card' => $card]);

        return $cards;
    }

    /**
     * @param CardCollection $collectionRow
     * @param User           $user
     *
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function removeCardFromCollection(CardCollection $collectionRow, User $user)
    {
        if ($collectionRow->getUser() == $user) {
            $this->em->remove($collectionRow);
            $this->em->flush();
        }
    }

    /**
     * @param           $set
     * @param array     $cards
     * @param User      $user
     *
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function addArrayToCollection($set, array $cards, User $user)
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

    /**
     * @param $user
     *
     * @return array|CardCollection[]
     */
    public function getByUser(User $user)
    {
        $fromCollection = $this->em->getRepository('MtgBundle:CardCollection')->findBy(['user' => $user]);

        return $fromCollection;
    }

    /**
     * @param User $user
     *
     * @return array|CardCollection[]
     */
    public function getRows(User $user)
    {
        $fromCollection = $this->getByUser($user);
        return $fromCollection;
    }

}