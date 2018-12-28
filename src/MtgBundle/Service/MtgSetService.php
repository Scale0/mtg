<?php

namespace MtgBundle\Service;

use MtgBundle\Entity\CardSet;

class MtgSetService extends MtgService
{
    /**
     * @param $set
     *
     * @return false|CardSet
     */
    public function CardSetExists($set)
    {
        $set = $this->getByCode($set->code);
        return $set ? $set : false;
    }

    /**
     * @return mixed
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function getAll()
    {
        $sets = $this->getResultsFromUrl('https://api.scryfall.com/sets');
        foreach($sets->data as $set) {
            if(!$this->CardSetExists($set)) {
                $this->saveSet($set);
            }
        }
        return $sets;
    }

    /**
     * @param     $code
     * @param int $page
     *
     * @return []
     */
    public function getAllCardsBySet($code, $page = 1)
    {
        usleep(100000);
        $url = 'https://api.scryfall.com/cards/search?order=set&q=e%3A' .$code . '&page=' . $page . '&unique=prints';

        $cardObject = $this->getResultsFromUrl($url, true);
        $cards = $cardObject['data'];
        if ($cardObject['has_more']) {
            $page = $page +1;
            $extraCard = $this->getAllCardsBySet($code, $page);
            $cards = array_merge(array_values($cards), array_values($extraCard));
        }
        return $cards;
    }

    /**
     * @param $code
     *
     * @return CardSet
     */
    public function getByCode($code)
    {
        return $this->em->getRepository('MtgBundle:CardSet')->findOneByCode($code);
    }

    /**
     * @param $set
     *
     * @return CardSet
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function saveSet($set, $skipFlush = false)
    {
        $newSet = $this->CardSetExists($set);
        if (!$newSet) {
            $newSet = new CardSet();
        }
        $releaseDate = !empty($set->released_at) ? new \DateTime($set->released_at) : null;
        $icon = strstr($set->icon_svg_uri, "?", true);
        $newSet
            ->setName($set->name)
            ->setCode($set->code)
            ->setCardCount($set->card_count)
            ->setIcon($icon)
            ->setReleaseDate($releaseDate);
        if (isset($set->parent_set_code)) {
            $newSet->setParent($set->parent_set_code);
        }
        $this->em->persist($newSet);
        if (!$skipFlush) {
            $this->em->flush();
        }
        return $newSet;
    }

    public function update()
    {
        $sets = $this->getResultsFromUrl('https://api.scryfall.com/sets');
        foreach($sets->data as $set) {
            $this->saveSet($set, true);
        }
        $this->em->flush();
        die();
    }
}