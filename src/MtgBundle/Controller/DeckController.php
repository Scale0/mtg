<?php

namespace MtgBundle\Controller;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\ColumnChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use MtgBundle\Form\Deck\createDeckType;
use MtgBundle\MtgBundle;
use MtgBundle\Service\MtgCardService;
use MtgBundle\Service\MtgDeckService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DeckController extends Controller
{
    private $deckService;
    private $cardService;
    public function __construct(MtgDeckService $deckService, MtgCardService $cardService)
    {
        $this->deckService = $deckService;
        $this->cardService = $cardService;
    }
    /**
     * @Route("/deck/create")
     */
    public function create(Request $request)
    {
        $form = $this->createForm(createDeckType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $name = $form->getData()['name'];
            $user = $this->getUser();
            $newdeck = $this->deckService->createDeck($name, $user);
            return $this->redirectToRoute('mtg_deck_view', ['id' => $newdeck->getId()]);
        }
        return $this->render('MtgBundle:Collection:create.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @param $deckId
     * @param $setCode
     * @param $cardCollectionId
     * @Route("/deck/addCard/{deckId}/{setCode}/{cardCollectionId}/")
     */
    public function addCardToDeck($deckId, $setCode, $cardCollectionId)
    {
        $deck = $this->deckService->getDeck($deckId);
        if ($deck->getUser() !== $this->getUser()) {
            die('dit is niet jou deck vrind');
        }
        $card = $this->cardService->get($setCode, $cardCollectionId);
        $this->deckService->addCardToDeck($deck, $card);
        
        return $this->redirectToRoute('mtg_deck_view', ['id' => $deck->getId()]);
    }

    /**
     * @Route("/deck/addCard")
     */
    public function addCard(Request $request)
    {
        if ($request->isMethod('POST')) {
            $deck = $this->deckService->getDeck($request->request->get('deck'), $this->getUser());
            $card = $this->cardService->get($request->request->get('set'), $request->request->get('card'));
            $amount = $request->request->get('amount');
            for ($i = 1; $i <= $amount; $i++) {
                $this->deckService->addCardToDeck($deck, $card);
            }
            return $this->redirectToRoute('mtg_deck_view', ['id' => $deck->getId()]);
        }
        return $this->redirectToRoute('mtg_card_index');
    }

    /**
     * @param $id
     * @Route("/deck/{id}")
     */
    public function view($id)
    {

        $deckCards = $this->deckService->getDeckCards($id);
        $deck = $this->deckService->getDeck($id);
        if (!$deck) {
            die('deck bestaat niet');
        }
        if (!$deckCards) {
            die('geen kaarten in deck!');
        }
        $charts = $this->deckService->buildCharts($deck);

        $exampleHand = $this->deckService->exampleHand($deck);

        return $this->render('MtgBundle:Deck:view.html.twig', [
            'deck' => $deck,
            'cards' => $deckCards,
            'charts' => $charts,
            'exampleHand' => $exampleHand
        ]);
    }
}