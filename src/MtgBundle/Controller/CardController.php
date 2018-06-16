<?php

namespace MtgBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class CardController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
#            return $this->redirectToRoute('mtg_user_index', [''])
        }
        dump($this->getUser());die();
        return $this->render('MtgBundle:Card:index.html.twig');
    }

    /**
     *
     * @Route("/card/all/{set}")
     */
    public function getAllCards($set)
    {
        for($i = 1, $continue = true; $continue; $i++){
            $continue = $this->get('mtg.card')->get($set, $i);
        }

        return $this->render('MtgBundle:Default:index.html.twig');
    }

    /**
     * @param $query
     * @Route("/card/search")
     */
    public function searchCard()
    {
        $cardService = $this->get('mtg.card');
        $search = Request::createFromGlobals()->request->get('q');
        if ($search  == null) {
            return $this->redirectToRoute('mtg_collection_getcollection');
        }
        if (!empty($search)) {
            $results = $cardService->searchCard($search);
        }

        return $this->render('MtgBundle:Card:searchresult.html.twig', ['results' => $results]);
    }

    /**
     * @param $set
     * @param $collectionId
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/card/get/{set}/{collectionId}")
     */
    public function getCard($set, $collectionId)
    {
        $card = $this->get('mtg.card')
            ->get($set, $collectionId)
        ;

        $collectedCount = $this->get('mtg.collection')->getCollectionRow($this->getUser(), $card);

        $decks = $this->get('mtg.deck')->getDecks($this->getUser());

        $prints = [];
        if (!in_array($card->getType(), ['Basic Land', 'Land'])) {
            $prints = $this->get('mtg.card')->getPrints($card);
        }

        return $this->render('MtgBundle:Card:card.html.twig', [
            'card' => $card,
            'decks' => $decks,
            'collectedCount' => $collectedCount ? $collectedCount->getAmount() : null,
            'prints' => $prints,
            'legality' => $card->getLegality()
        ]);
    }

    /**
     * @Route("/card/update/{set}/{collectionId}")
     * @param $set
     * @param $card
     */
    public function updateCards($set, $collectionId)
    {
        $getCard = $this->get('mtg.card')
            ->updateCards();

        echo "ahaha";
        die();
    }
}
