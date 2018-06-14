<?php

namespace MtgBundle\Controller;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\ColumnChart;
use MtgBundle\Form\Deck\createDeckType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DeckController extends Controller
{
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
            $newdeck = $this->get('mtg.deck')->createDeck($name, $user);
            return $this->redirectToRoute('mtg_deck_view', ['id' => $newdeck->getId()]);
        }
        return $this->render('MtgBundle:Collection:create.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @param $id
     * @Route("/deck/view/{id}")
     */
    public function view($id)
    {
        $deckService = $this->get('mtg.deck');
        $deckCards = $deckService->getDeckCards($id);
        $deck = $deckService->getDeck($id);
        $manacosts = $deckService->getConvertedManaByDeck($id);
        $dataArray[] = ['mana', 'cards'];
        foreach ($manacosts as $key => $value) {
            $dataArray[] = [$key, $value];
        }
        $chart = new ColumnChart();
        $chart->getData()->setArrayToDataTable($dataArray);
        $chart->getOptions()
            ->setTitle('Manacosts')
            ->setColors(['#b15e0a'])
            ->setHeight(500)
            ->setWidth(500);

        return $this->render('MtgBundle:Deck:view.html.twig', ['deck' => $deck, 'cards' => $deckCards, 'manaChart' => $chart]);
    }

    /**
     * @param $deckId
     * @param $setCode
     * @param $cardCollectionId
     * @Route("/deck/addCard/{deckId}/{setCode}/{cardCollectionId}/")
     */
    public function addCardToDeck($deckId, $setCode, $cardCollectionId)
    {
        $deckService = $this->get('mtg.deck');
        $deck = $deckService->getDeck($deckId);
        $card = $this->get('mtg.card')->get($setCode, $cardCollectionId);
        $deckService->addCardToDeck($deck, $card);

        return $this->redirectToRoute('mtg_deck_view', ['id' => $deck->getId()]);
    }

    /**
     * @Route("/deck/addCard")
     */
    public function addCard(Request $request)
    {
        if ($request->isMethod('POST')) {
            $deckService = $this->get('mtg.deck');
            $cardService = $this->get('mtg.card');
            $deck = $deckService->getDeck($request->request->get('deck'));
            $card = $cardService->get($request->request->get('set'), $request->request->get('card'));
            $amount = $request->request->get('amount');
            for ($i = 0; $i <= $amount; $i++) {
                $deckService->addCardToDeck($deck, $card);
            }
            return $this->redirectToRoute('mtg_deck_view', ['id' => $deck->getId()]);
        }
        return $this->redirectToRoute('mtg_card_index');
    }
}