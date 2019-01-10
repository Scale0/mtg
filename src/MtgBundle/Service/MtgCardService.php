<?php

namespace MtgBundle\Service;

use MtgBundle\Entity\Card;
use MtgBundle\Entity\CardFace;
use MtgBundle\Entity\CardSet;
use MtgBundle\Resources\Finals\cardType;
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
        $newcard = $this->getResultsFromUrl("https://api.scryfall.com/cards/".$cardSet."/".$collectionId, true);

        $card = $this->saveCardObject($newcard);

        $this->em->persist($card);
        $this->em->flush();

        return $card;
    }

    private function saveCardObject($apiCard)
    {
        if ($apiCard['object'] == 'error') {
            return false;
        }

        $cardSet = $this->em->getRepository("MtgBundle:CardSet")->findOneByCode($apiCard['set']);
        $card = new Card();

        if (!empty($apiCard['card_faces']) && is_array($apiCard['card_faces'])) {
            foreach($apiCard['card_faces'] as $cardFace) {
                $newCardFace = new CardFace();
                $newCardFace->setName($cardFace['name'])
                    ->setTypeLine($cardFace['type_line'] ?? null)
                    ->setPower($cardFace['power'] ?? null)
                    ->setToughness($cardFace['toughness'] ?? null)
                    ->setFlavorText($cardFace['flavor_text'] ?? null)
                    ->setLoyalty($cardFace['loyalty'] ?? null )
                    ->setManaCost($cardFace['mana_cost'] ?? null)
                    ->setOracleText($cardFace['oracle_text'] ?? null)
                    ->setCard($card)
                ;
                if ($apiCard['layout'] == 'split') {
                    $newCardFace->setImgUrl($apiCard['image_uris']['normal'])
                                ->setColors($apiCard['colors'] ?? null)
                    ;
                } else {
                    $newCardFace->setImgUrl($cardFace['image_uris']['normal'])
                                ->setColors($cardFace['colors'] ?? null)
                    ;
                }
                $card->addCardFace($newCardFace);
            }
        } else {
            $newCardFace = new CardFace();
            $newCardFace->setName($apiCard['name'])
                ->setTypeLine($apiCard['type_line'] ?? null)
                ->setPower($apiCard['power'] ?? null)
                ->setToughness($apiCard['toughness'] ?? null)
                ->setColors($apiCard['colors'] ?? null)
                ->setFlavorText($apiCard['flavor_text'] ?? null)
                ->setImgUrl($apiCard['image_uris']['normal'])
                ->setLoyalty($apiCard['loyalty'] ?? null )
                ->setManaCost($apiCard['mana_cost'] ?? null)
                ->setOracleText($apiCard['oracle_text'] ?? null)
                ->setCard($card)
            ;
            $card->addCardFace($newCardFace);
        }
        $card
            ->setCollectionId($apiCard['collector_number'])
            ->setName($apiCard['name'])
            ->setCardSet($cardSet)
            ->setConvertedManaCosts($apiCard['cmc'])
            ->setRarity($apiCard['rarity'])
            ->setLegality($apiCard['legalities'])
        ;

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
        $setService = $cardSet = $this->em->getRepository("MtgBundle:CardSet");
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

    public function saveListOfCards($cardList)
    {
        $i = 0;
        foreach($cardList as $card) {
            $cardObject = $this->saveCardObject($card);
            $this->em->persist($cardObject);
            $i++;
        }
        $this->em->flush();
        die('in totaal ' . $i . ' kaarten toegevoegd');
    }

    public function getArrayOfCardsByCollectionIds($setCode, $collectionIds)
    {
        $set = $this->em->getRepository('MtgBundle:CardSet')->findOneByCode($setCode);

        $cards = $this->em->getRepository('MtgBundle:Card')->getArrayBySetAndCollectionIds($set, $collectionIds);

        return $cards;
    }

    public function updateCards()
    {
        #foreach($cards as $card) {
      #      $this->em->persist($card);
        #}
        #$this->em->flush();
    }
}