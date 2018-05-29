<?php

namespace MtgBundle\Service;

use MtgBundle\Entity\Card;
use MtgBundle\Form\CardCollection\massCardCollectionType;

class MtgExtraLiveDataService extends MtgService
{
    public function getCardRules(Card $card)
    {
        $rules = $this->getResultsFromUrl('https://api.scryfall.com/cards/' . $card->getCardSet()->getCode() . '/' . $card->getCollectionId() . '/rulings');
        $newrule = false;
        foreach($rules->data as $rule) {
            $newrule[] = [
                'published' => $rule->published_at,
                'comment' => $rule->comment
            ];
        }
        return $newrule;
    }
}