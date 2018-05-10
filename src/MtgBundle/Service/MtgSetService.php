<?php
/**
 * Created by PhpStorm.
 * User: sjoerddewaard
 * Date: 07-05-18
 * Time: 19:36
 */

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
    public function saveSet($set)
    {
        $newSet = new CardSet();
        $releaseDate = !empty($set->released_at) ? new \DateTime($set->released_at) : null;
        $newSet
            ->setName($set->name)
            ->setCode($set->code)
            ->setCardCount($set->card_count)
            ->setReleaseDate($releaseDate);
        $this->em->persist($newSet);
        $this->em->flush();
        return $newSet;
    }
}