<?php

namespace MtgBundle\Repository;

use MtgBundle\Entity\Card;

/**
 * CardRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CardRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * @param $circuitId
     *
     * @return Card|object
     */
    public function getBySetAndCollection($set, $collection_id)
    {
        return $this->findOneBy(['CardSet' => $set, 'collectionId' => $collection_id]);
    }
}
