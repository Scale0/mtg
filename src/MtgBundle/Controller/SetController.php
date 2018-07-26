<?php

namespace MtgBundle\Controller;

use MtgBundle\Service\MtgCardService;
use MtgBundle\Service\MtgSetService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SetController extends Controller
{
    private $setService;
    private $cardService;
    public function __construct(MtgSetService $setService, MtgCardService $cardService)
    {
        $this->setService = $setService;
        $this->cardService = $cardService;
    }
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    /**
     * @Route("/set/get/all")
     */
    public function getAllSets()
    {
        $this->setService->getAll();

        return $this->render('MtgBundle:Card:index.html.twig');
    }

    /**
     * @param $code
     * @Route("/set/get/{code}")
     */
    public function getCompleteSet($code)
    {
        $cards = $this->setService->getAllCardsBySet($code);
        $this->cardService->saveListOfCards($cards);
    }

    /**
     * @route("/set/update/all")
     */
    public function updateSet()
    {
        $this->setService->update();
    }
}
