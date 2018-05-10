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
        $continue = true;
        $card = $this->get('mtg.card');
        $i = 1;
        while($continue) {
            $continue = $card->get($set, $i);
            $i++;
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

        return $this->render('MtgBundle:Default:card.html.twig', ['card' => $card]);
    }
}
