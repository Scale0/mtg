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

        $cardSet = $this->em->getRepository("MtgBundle:cardSet")->findOneByCode($apiCard['set']);
        $card = new Card();

        if (!empty($apiCard['card_faces']) && is_array($apiCard['card_faces'])) {
            foreach($apiCard['card_faces'] as $cardFace) {
                $newCardFace = new CardFace();
                $newCardFace->setName($cardFace['name'])
                    ->setTypeLine($cardFace['type_line'])
                    ->setPower($cardFace['power'] ?? null)
                    ->setToughness($cardFace['toughness'] ?? null)
                    ->setColors($cardFace['colors'])
                    ->setFlavorText($cardFace['flavor_text'] ?? null)
                    ->setImgUrl($cardFace['image_uris']['normal'])
                    ->setLoyalty($cardFace['loyalty'] ?? null )
                    ->setManaCost($cardFace['mana_cost'])
                    ->setOracleText($cardFace['oracle_text'])
                    ->setCard($card)
                ;
                $card->addCardFace($newCardFace);
            }
        } else {
            $newCardFace = new CardFace();
            $newCardFace->setName($apiCard['name'])
                ->setTypeLine($apiCard['type_line'])
                ->setPower($apiCard['power'] ?? null)
                ->setToughness($apiCard['toughness'] ?? null)
                ->setColors($apiCard['colors'])
                ->setFlavorText($apiCard['flavor_text'] ?? null)
                ->setImgUrl($apiCard['image_uris']['normal'])
                ->setLoyalty($apiCard['loyalty'] ?? null )
                ->setManaCost($apiCard['mana_cost'])
                ->setOracleText($apiCard['oracle_text'])
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