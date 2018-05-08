<?php

namespace MtgBundle\Controller;

use MtgBundle\Entity\Card;
use MtgBundle\Service\MtgCardService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
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
        for($i = 1; $continue; $i++) {
            $continue = $card->get($set, $i);
        }

        return $this->render('MtgBundle:Default:index.html.twig');
    }

    /**
     * @param $set
     * @param $collectionId
     *
     * @Route("/card/get/{set}/{collectionId}")
     * @return Card|false
     */
    public function getCard($set, $collectionId)
    {
        $card = $this->get('mtg.card')->get($set, $collectionId);
        return $this->render('MtgBundle:Default:card.html.twig', ['card'=>$card]);
    }

    /**
     * @Route("/set/get/all", name="getAllSets")
     */
    public function getAllSets()
    {

        $set = $this->get('mtg.set');

        $set->getSets();
        return $this->render('MtgBundle:Default:index.html.twig');
    }

}
