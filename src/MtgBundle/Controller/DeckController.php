<?php

namespace MtgBundle\Controller;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\ColumnChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
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
     * @Route("/deck/{id}")
     */
    public function view($id)
    {
        $deckService = $this->get('mtg.deck');
        $deckCards = $deckService->getDeckCards($id);
        $deck = $deckService->getDeck($id);
        $manacosts = $deckService->getConvertedManaByDeck($id);
        $manaData[] = ['mana', 'cards'];
        foreach ($manacosts as $key => $value) {
            $manaData[] = [['f' => $key], ['v' => $value]];
        }
        $manaChart = new ColumnChart();
        $manaChart->getData()->setArrayToDataTable($manaData);
        $manaChart->getOptions()
            ->setTitle('Manacosts')
            ->setHeight(200)
            ->setWidth(300)
            ->setColors(['#b15e0a']) ;
        foreach($deckCards as $deckCard) {
            dump($deckCard->getCard()->getName());
            dump($deckCard->getCard()->getColors());
        }
        $colorChart = new PieChart();

        return $this->render('MtgBundle:Deck:view.html.twig', ['deck' => $deck, 'cards' => $deckCards, 'manaChart' => $manaChart]);
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
        if ($deck->getUser() !== $this->getUser()) {
            die('dit is niet jou deck vrind');
        }
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
            $deck = $deckService->getDeck($request->request->get('deck'), $this->getUser());
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