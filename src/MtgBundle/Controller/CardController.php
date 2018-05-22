<?php

namespace MtgBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CardController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('MtgBundle:Default:index.html.twig');
    }

    /**
     *
     * @Route("/card/all/{set}")
     */
    public function getAllCards($set)
    {
        $card = $this->get('mtg.card');
        for($i = 1, $continue = true; $continue; $i++){
            $continue = $card->get($set, $i);
        }

        return $this->render('MtgBundle:Default:index.html.twig');
    }

    /**
     * @param $set
     * @param $collectionId
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\OptimisticLockException
     * @Route("/card/get/{set}/{collectionId}")
     */
    public function getCard($set, $collectionId)
    {
        $card = $this->get('mtg.card')
            ->get($set, $collectionId)
        ;

        $extraInfo = $this->get('mtg.extrainfo');
        $rules = $extraInfo->getCardRules($card);
        $pricing = $extraInfo->getCardPricing($card);
        $legality = $extraInfo->getCardLegality($card);

        return $this->render('MtgBundle:Card:card.html.twig', [
            'card' => $card,
            'rules' => $rules,
            'pricing' => $pricing,
            'legality' => $legality
        ]);
    }
}
