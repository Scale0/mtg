<?php

namespace MtgBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SetController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    /**
     * @Route("/set/get/all", name="getAllSets")
     */
    public function getAllSets()
    {

        $set = $this->get('mtg.set');

        $set->getAll();

        return $this->render('MtgBundle:Default:index.html.twig');
    }
}
