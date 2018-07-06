<?php

namespace MtgBundle\Controller;

use MtgBundle\Service\MtgSetService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SetController extends Controller
{
    private $setService;
    public function __construct(MtgSetService $setService)
    {
        $this->setService = $setService;
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
        dump($this->setService->getAllCardsBySet($code)); die();
    }

    /**
     * @route("/set/update/all")
     */
    public function updateSet()
    {
        $this->setService->update();
    }
}
