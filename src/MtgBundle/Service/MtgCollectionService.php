<?php

namespace MtgBundle\Service;

use MtgBundle\Entity\CardCollection;

class MtgCollectionService extends MtgService
{
    public function saveCollection($collection)
    {
        $this->em->persist($collection);
        $this->em->flush();
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

}