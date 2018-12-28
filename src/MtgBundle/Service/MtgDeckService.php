<?php

namespace MtgBundle\Service;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\ColumnChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use MtgBundle\Entity\Card;
use MtgBundle\Entity\Deck;
use MtgBundle\Entity\DeckCards;
use MtgBundle\Entity\User;

class MtgDeckService extends MtgService
{
    /**
     * @param $name
     * @param $user
     *
     * @return Deck
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createDeck($name, $user)
    {
        $deck = new Deck();

        $deck
            ->setUser($user)
            ->setName($name);

        $this->em->persist($deck);
        $this->em->flush();

        return $deck;

    }

    /**
     * @param $user
     *
     * @return Deck[]
     */
    public function getDecks($user)
    {
        return $this->em->getRepository('MtgBundle:Deck')->findBy(['user' => $user]);
    }

    /**
     * @param $id
     * @param User $user
     *
     * @return Deck|null|object
     */
    public function getDeck($id)
    {
        return $this->em->getRepository('MtgBundle:Deck')
            ->findOneBy(['id' => $id]);
    }

    /**
     * @param      $id
     *
     * @return DeckCards[]
     */
    public function getDeckCards($deckId)
    {
        $cards = $this->em->getRepository('MtgBundle:DeckCards')
            ->getCardsOrderedByType($deckId);
        return $cards;
    }

    /**
     * @param Deck $deck
     * @param Card $card
     *
     * @return DeckCards
     */
    public function addCardToDeck(Deck $deck, Card $card)
    {
        $existingDeckCard = $this->em->getRepository('MtgBundle:DeckCards')
            ->findOneBy(['deck' => $deck, 'card' => $card]);

        if ($existingDeckCard) {
            $existingDeckCard->addOne();
            $this->em->persist($existingDeckCard);
            $this->em->flush();
            return $existingDeckCard;
        }

        $DeckCard = new DeckCards();
        $DeckCard->setDeck($deck)
            ->setCard($card);
        $this->em->persist($DeckCard);
        $this->em->flush();

        return $DeckCard;

    }

    public function getConvertedManaByDeck(Deck $deck)
    {
        $manaCosts = [];
        $cards = $this->em->getRepository('MtgBundle:DeckCards')
            ->getCardsWithMoreThenZeroCmC($deck);
            ;
        foreach($cards as $card) {
            $key = $card->getCard()->getConvertedManaCosts();
            $manaCosts[$key] =
                (!empty($manaCosts[$key]) ?
                    $manaCosts[$key] + $card->getAmount() :
                    $card->getAmount());
        }

        ksort($manaCosts);
        return $manaCosts;
    }

    /**
     * @param Deck $deck
     *
     * @return array
     */
    public function getColors(Deck $deck)
    {
        $deckColors = [];
        $cards = $this->em->getRepository('MtgBundle:DeckCards')
            ->findBy(['deck' => $deck]);
        foreach ($cards as $card) {
            if (isset($card->getCard()->getFaces()->first()->getColors()[0])) {
                $key = $card->getCard()->getFaces()->first()->getColors()[0];
                $deckColors[$key] =
                    (!empty($deckColors[$key]) ?
                        $deckColors[$key] + $card->getAmount() :
                        $card->getAmount());
            }
        }
        return $deckColors;
    }

    /**
     * @param Deck $deck
     *
     * @return array
     */
    public function getTypes(Deck $deck)
    {
        $deckTypes = [];
        $cards = $this->em->getRepository('MtgBundle:DeckCards')
            ->findBy(['deck' => $deck]);

        foreach($cards as $card) {
            $key = $card->getCard()->getFaces()->first()->getType();
            $deckTypes[$key] =
                (!empty($deckTypes[$key]) ?
                    $deckTypes[$key] + $card->getAmount() :
                    $card->getAmount()
                );
        }
        return $deckTypes;
    }

    public function buildCharts($deck)
    {
        $manacosts = $this->getConvertedManaByDeck($deck);
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
            ->setColors(['#b15e0a'])
            ->getLegend()->setPosition('none');

        #$manaChart->getOPtions()->getLegend()->setPosition('none');

        $cardColors = $this->getColors($deck);
        $colorData[] = ['card', 'color'];
        foreach($cardColors as $name => $color) {
            switch (strtolower($name)) {
                case 'b':
                    $name = 'Black';
                    $schemaColor[] = '#150b00';
                    break;
                case 'w':
                    $name = 'White';
                    $schemaColor[] = '#f9faf4';
                    break;
                case 'u':
                    $name = 'Blue';
                    $schemaColor[] = '#0e68ab';
                    break;
                case 'g':
                    $name = 'Green';
                    $schemaColor[] = '#00733e';
                    break;
                case 'r':
                    $name = 'Red';
                    $schemaColor[] = '#d3202a';
                    break;
            }
            $colorData[] = [$name, $color];
        }
        $colorChart = new PieChart();
        $colorChart->getData()->setArrayToDataTable($colorData);
        $colorChart->getOptions()
            ->setHeight(200)
            ->setWidth(300)
            ->setColors($schemaColor)
            ->setIs3D(true);

        $cardTypes = $this->getTypes($deck);
        $types[] = ['type', 'amount'];
        foreach($cardTypes as $name => $cardType) {
            $types[] = [$name, $cardType];
        }
        $typeChart = new PieChart();
        $typeChart->getData()->setArrayToDataTable($types);
        $typeChart->getOptions()
            ->setHeight(200)
            ->setWidth(300)
            ->setIs3D(true);

        $charts['chart'][] = $manaChart;
        $charts['chart'][] = $colorChart;
        $charts['chart'][] = $typeChart;
        $charts['div'][] = 'div_manaCurve';
        $charts['div'][] = 'div_colorCosts';
        $charts['div'][] = 'div_types';

        return $charts;
    }

    /**
     * @param Deck $deck
     */
    public function exampleHand(Deck $deck)
    {
        $cards = $deck->getDeckCards();
        $deckCards = [];
        foreach($cards as $card) {
            for ($i = 0; $i < $card->getAmount(); $i++) {
                $deckCards[] = $card->getCard();
            }
        }
        $randomKeys = array_rand($deckCards, 7);
        shuffle($randomKeys);
        foreach($randomKeys as $key => $value) {
            $returnHand[] = $deckCards[$value];
        }
        return $returnHand;
    }
}