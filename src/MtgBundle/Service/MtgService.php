<?php

namespace MtgBundle\Service;

use Doctrine\ORM\EntityManager;
use MtgBundle\Entity\Card;

/**
 * Class MtgService
 *
 * @package MtgBundle\Service
 */
class MtgService
{
    /**
     * @var EntityManager
     */
    private $em;
    public function __construct(EntityManager $entityManager) {
        $this->em = $entityManager;
    }

    /**
     * @param $cardSet
     * @param $collectionId
     *
     * @return bool|Card
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function getCard($cardSet, $collectionId)
    {
        $existingCard = $this->em->getRepository('MtgBundle:Card')
            ->getBySetAndCollection($cardSet, $collectionId)
        ;

        if ($existingCard) {
            return $existingCard;
        }

        usleep(100000);
        $newcard = $this->getResultsFromUrl("https://api.scryfall.com/cards/".$cardSet."/".$collectionId);

        if ($newcard->object == 'error') {
            return false;
        }

        if (!empty($newcard->card_faces) && is_array($newcard->card_faces)) {
            $cardImage = $newcard->card_faces[0]->image_uris->normal;
            $type_line = $newcard->card_faces[0]->type_line;
            $oracle_text = !empty($newcard->card_faces[0]->oracle_text) ? $newcard->card_faces[0]->oracle_text : null;
            $flavor_text = !empty($newcard->card_faces[0]->flavor_text) ? $newcard->card_faces[0]->flavor_text : null;
            $mana_cost = $newcard->card_faces[0]->mana_cost;
            $color = $newcard->card_faces[0]->colors;
        } else {
            $cardImage = $newcard->image_uris->normal;
            $type_line = $newcard->type_line;
            $oracle_text = !empty($newcard->oracle_text) ? $newcard->oracle_text : null;
            $flavor_text = !empty($newcard->flavor_text) ? $newcard->flavor_text : null;
            $mana_cost = $newcard->mana_cost;
            $color = $newcard->colors;
        }
        $cardImage = strstr($cardImage, "?", true);
        $card = new Card();
        $card
            ->setCollectionId($newcard->collector_number)
            ->setImgUrl($cardImage)
            ->setName($newcard->name)
            ->setCardSet($newcard->set)
            ->setTypeLine($type_line)
            ->setOracleText($oracle_text)
            ->setFlavorText($flavor_text)
            ->setManaCost($mana_cost)
            ->setRarity($newcard->rarity)
            ->setPower(!empty($newcard->power) ? $newcard->power : null)
            ->setToughness(!empty($newcard->toughness) ? $newcard->toughness : null)
            ->setColors($color)
        ;
        $this->em->persist($card);
        $this->em->flush();

        return $card;
    }

    private function getResultsFromUrl($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        CURL_SETOPT($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        return json_decode($result);
    }

}