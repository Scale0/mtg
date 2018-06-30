<?php

namespace MtgBundle\Service;

use MtgBundle\Entity\Card;
use MtgBundle\Entity\CardSet;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Class MtgCardService
 *
 * @package MtgBundle\Service
 */
class MtgCardService extends MtgService
{
    /**
     * @param string $cardSet
     * @param integer $collectionId
     *
     * @return bool|Card
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    private function save($cardSet, $collectionId)
    {
        usleep(100000);
        $newcard = $this->getResultsFromUrl("https://api.scryfall.com/cards/".$cardSet."/".$collectionId);

        $card = $this->saveCardObject($newcard);

        $this->em->persist($card);
        $this->em->flush();

        return $card;
    }

    /**
     * @param Card $card
     *
     * @return string
     */
    private function saveImage(Card $card)
    {
        $filesystem = new Filesystem();

        $directory = __DIR__ . '/../../../web/images/cards/' . $card->getCardSet()->getCode();

        $imageDestination = $directory . '/' . $card->getCollectionId() . '.jpg';

        if (!$filesystem->exists($imageDestination)) {
            $filesystem->copy($card->getImgUrl(), $imageDestination);
        }

        return 'images/cards/'.$card->getCardSet()->getCode().'/'.$card->getCollectionId().'.jpg';
    }

    private function saveCardObject($apiCard)
    {
        if ($apiCard->object == 'error') {
            return false;
        }

        if (!empty($apiCard->card_faces) && is_array($apiCard->card_faces)) {
            $cardImage = $apiCard->card_faces[0]->image_uris->normal;
            $type_line = $apiCard->card_faces[0]->type_line;
            $oracle_text = !empty($apiCard->card_faces[0]->oracle_text) ? $apiCard->card_faces[0]->oracle_text : null;
            $flavor_text = !empty($apiCard->card_faces[0]->flavor_text) ? $apiCard->card_faces[0]->flavor_text : null;
            $mana_cost = str_replace('/', '', $apiCard->card_faces[0]->mana_cost);
            $color = $apiCard->card_faces[0]->colors;

            $power =
                (!empty($apiCard->card_faces[0]->loyalty) ?
                    $apiCard->card_faces[0]->loyalty :
                    (!empty($apiCard->card_face[0]->power) ?
                        $apiCard->card_face[0]->power:
                        null));
        } else {
            $cardImage = $apiCard->image_uris->normal;
            $type_line = $apiCard->type_line;
            $oracle_text = !empty($apiCard->oracle_text) ? $apiCard->oracle_text : null;
            $flavor_text = !empty($apiCard->flavor_text) ? $apiCard->flavor_text : null;
            $mana_cost = str_replace('/', '', $apiCard->mana_cost);
            $color = $apiCard->colors;

            $power =
                (!empty($apiCard->loyalty) ?
                    $apiCard->loyalty :
                    (!empty($apiCard->power) ?
                        $apiCard->power :
                        null));
        }
        $cardImage = strstr($cardImage, "?", true);
        $legality = $apiCard->legalities;

        $cardSet = $this->em->getRepository("MtgBundle:cardSet")->findOneByCode($apiCard->set);
        $card = new Card();
        $card
            ->setCollectionId($apiCard->collector_number)
            ->setImgUrl($cardImage)
            ->setName($apiCard->name)
            ->setCardSet($cardSet)
            ->setTypeLine($type_line)
            ->setOracleText($oracle_text)
            ->setFlavorText($flavor_text)
            ->setManaCost($mana_cost)
            ->setConvertedManaCosts($apiCard->cmc)
            ->setRarity($apiCard->rarity)
            ->setPower(!empty($power) ? $power : null)
            ->setToughness(!empty($apiCard->toughness) ? $apiCard->toughness : null)
            ->setColors($color)
            ->setLegality($legality)
        ;
        $card->setImgUrl($this->saveImage($card));

        return $card;
    }

    /**
     * @param string $cardSet
     * @param integer $collectionId
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

    /**
     * @param $query
     *
     * @return mixed
     */
    public function searchCard($query)
    {
        return $this->getResultsFromUrl('https://api.scryfall.com/cards/search?q=' . $query);
    }

    /**
     * @param Card $card
     *
     * @return array
     */
    public function getPrints(Card $card)
    {
        $url = 'https://api.scryfall.com/cards/search?order=set&q=!%22' . str_replace(" ", "%20", $card->getName()) . '%22&unique=prints';
        $prints = $this->getResultsFromUrl($url)->data;
        $setService = $cardSet = $this->em->getRepository("MtgBundle:cardSet");
        $return = [];
        foreach($prints as $print){
            $set = $setService->findOneByCode($print->set);
            $return[] = [
                'setname' => $set->getName(),
                'setcode' => $set->getCode(),
                'icon' => $set->getIcon(),
                'collectionId' => $print->collector_number
            ];
        }
        return $return;
    }

    public function updateCards()
    {
        #foreach($cards as $card) {
      #      $this->em->persist($card);
        #}
        #$this->em->flush();
    }
}