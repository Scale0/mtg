<?php

namespace MtgBundle\Controller;

use MtgBundle\Entity\Card;
use MtgBundle\Service\CardService;
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
     * @Route("/mtg/getAllCards/{set}")
     */
    public function getAllCards($set)
    {
        $continue = true;
        $mtg = $this->get('mtg.mtg');
        for($i = 1; $continue; $i++) {
            $continue = $mtg->getCard($set, $i);
        }

        return $this->render('MtgBundle:Default:index.html.twig');
    }

    /**
     * @param $set
     * @param $collectionId
     *
     * @Route("/getCard/{set}/{collectionId}")
     * @return Card|false
     */
    public function getCard($set, $collectionId)
    {
        $card = $this->get('mtg.mtg')->getCard($set, $collectionId);
        return $this->render('MtgBundle:Default:card.html.twig', ['card'=>$card]);
    }

    /**
     * @Route("/getsets")
     *
     */
    public function getSets()
    {

        $mtg = $this->get('mtg.mtg');

        $sets = $mtg->getSets();
        die();
    }

    public function addCardToCollection($set, $collectionId)
    {

    }

    private function getResultsFromUrl($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        CURL_SETOPT($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        #echo $result;
        return json_decode($result);
    }
}
