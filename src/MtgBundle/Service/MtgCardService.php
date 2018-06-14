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
        $legality = $newcard->legalities;

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
            ->setLegality($legality)
        ;
        $card->setImgUrl($this->saveImage($card));
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
        $cards = $this->em->getRepository('MtgBundle:Card')->findAll();
        foreach($cards as $card) {

            $this->em->persist($card);
        }
        $this->em->flush();
    }
}