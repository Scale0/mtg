<?php

namespace MtgBundle\Controller;

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
        $deck = $this->get('mtg.deck')->getDeck($id, $this->getUser());
        dump($deck->getName());die();
    }

    /**
     * @param $deckId
     * @param $setCode
     * @param $cardCollectionId
     * @Route("/deck/addCard/{deckId}/{setCode}/{cardCollectionId}")
     */
    public function addCardToDeck($deckId, $setCode, $cardCollectionId)
    {
        $deckService = $this->get('mtg.deck');
        $deck = $deckService->getDeck($deckId, $this->getUser());
        $card = $this->get('mtg.card')->get($setCode, $cardCollectionId);
        $deckService->addCardToDeck($deck, $card);
        dump($deckService);die();
    }
}
