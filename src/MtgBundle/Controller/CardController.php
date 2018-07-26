<?php

namespace MtgBundle\Controller;

use MtgBundle\Service\MtgCollectionService;
use MtgBundle\Service\MtgDeckService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use MtgBundle\Service\MtgCardService;
use Symfony\Component\HttpFoundation\Request;

class CardController extends Controller
{
    private $cardService;
    private $collectionService;
    private $deckService;
    public function __construct(MtgCardService $cardService,MtgCollectionService $collectionService,MtgDeckService $deckService)
    {
        $this->cardService = $cardService;
        $this->collectionService = $collectionService;
        $this->deckService = $deckService;
    }
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
            $continue = $this->cardService->get($set, $i);
        }

        return $this->render('MtgBundle:Default:index.html.twig');
    }

    /**
     * @param $query
     * @Route("/card/search")
     */
    public function searchCard()
    {
        $search = Request::createFromGlobals()->request->get('q');
        if ($search  == null) {
            return $this->redirectToRoute('mtg_collection_getcollection');
        }
        if (!empty($search)) {
            $results = $this->cardService->searchCard($search);
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
        $card = $this->cardService
            ->get($set, $collectionId)
        ;

        $collectedCount = $this->collectionService->getCollectionRow($this->getUser(), $card);

        $decks = $this->deckService->getDecks($this->getUser());

        $prints = [];

        $faces = $card->getFaces();

        $types = [];
        foreach ($faces as $face) {
            $types = array_merge($types, [$face->getType()]);
        }
        if (!in_array($types, ['Basic Land', 'Land'])) {
            $prints = $this->cardService->getPrints($card);
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
        $getCard = $this->cardService
            ->updateCards();

        echo "ahaha";
        die();
    }
}
