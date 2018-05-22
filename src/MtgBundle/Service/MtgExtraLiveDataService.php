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

    public function getCardPricing(Card $card)
    {
        $card = $this->getResultsFromUrl('https://api.scryfall.com/cards/' . $card->getCardSet()->getCode() . '/' . $card->getCollectionId());

        if (!empty($card->card_faces) && is_array($card->card_faces)) {
            $returnvalues['usd'] = $card->card_faces[0]->usd;
            $returnvalues['eur'] = $card->card_faces[0]->eur;
        } else {
            $returnvalues['usd'] = $card->usd;
            $returnvalues['eur'] = $card->eur;
        }
        return $returnvalues;
    }

    public function getCardLegality(Card $card)
    {
        $card = $this->getResultsFromUrl('https://api.scryfall.com/cards/' . $card->getCardSet()->getCode() . '/' . $card->getCollectionId(), true);

        return !empty($card['card_faces']) && is_array($card['card_faces']) ? $card['card_faces'][0]['legalities'] : $card['legalities'];

    }
}