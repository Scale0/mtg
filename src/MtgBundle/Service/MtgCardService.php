<?php

namespace MtgBundle\Service;

use MtgBundle\Entity\Card;
use MtgBundle\Entity\CardSet;

/**
 * Class MtgCardService
 *
 * @package MtgBundle\Service
 */
class MtgCardService extends MtgService
{
    /**
     * @param string $cardSet
     * @param $collectionId
     *
     * @return bool|Card
     */
    public function get($cardSet, $collectionId)
    {
        $set = $this->em->getRepository('MtgBundle:CardSet')->findOneByCode($cardSet);

        $existingCard = $this->em->getRepository('MtgBundle:Card')
            ->getBySetAndCollection($set, $collectionId)
        ;

        if ($existingCard) {
            return $existingCard;
        }
        $card = $this->save($cardSet, $collectionId);
        return $card;
    }

    protected function save($cardSet, $collectionId)
    {
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
            $mana_cost = str_replace('/', '', $newcard->card_faces[0]->mana_cost);
            $color = $newcard->card_faces[0]->colors;
            $power =
                (!empty($newcard->card_faces[0]->loyalty) ?
                    $newcard->card_faces[0]->loyalty :
                    (!empty($newcard->card_face[0]->power) ?
                        $newcard->card_face[0]->power:
                        null));
        } else {
            $cardImage = $newcard->image_uris->normal;
            $type_line = $newcard->type_line;
            $oracle_text = !empty($newcard->oracle_text) ? $newcard->oracle_text : null;
            $flavor_text = !empty($newcard->flavor_text) ? $newcard->flavor_text : null;
            $mana_cost = str_replace('/', '', $newcard->mana_cost);
            $color = $newcard->colors;
            $power =
                (!empty($newcard->loyalty) ?
                    $newcard->loyalty :
                    (!empty($newcard->power) ?
                        $newcard->power :
                        null));
        }
        $cardImage = strstr($cardImage, "?", true);
        $cardSet = $this->em->getRepository("MtgBundle:cardSet")->findOneByCode($newcard->set);
        $card = new Card();
        $card
            ->setCollectionId($newcard->collector_number)
            ->setImgUrl($cardImage)
            ->setName($newcard->name)
            ->setCardSet($cardSet)
            ->setTypeLine($type_line)
            ->setOracleText($oracle_text)
            ->setFlavorText($flavor_text)
            ->setManaCost($mana_cost)
            ->setRarity($newcard->rarity)
            ->setPower(!empty($power) ? $power : null)
            ->setToughness(!empty($newcard->toughness) ? $newcard->toughness : null)
            ->setColors($color)
        ;
        $this->em->persist($card);
        $this->em->flush();

        return $card;
    }
}