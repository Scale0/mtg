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
        $card = $this->get('mtg.mtg');
        for($i = 1; $continue; $i++) {
            $continue = $card->getCard($set, $i);

        }
        echo "alles op gehaald";
        die();
    }

    /**
     * @param $set
     * @param $collectionId
     *
     * @Route("/mtg/getCard/{set}/{collectionId}")
     * @return Card|false
     */
    public function getCard($set, $collectionId)
    {
        var_dump($this->get('mtg.mtg')->getCard($set, $collectionId));
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
