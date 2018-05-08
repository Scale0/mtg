<?php

namespace MtgBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CollectionController extends Controller
{
    /**
     * @param $setCode
     * @param $collectionId
     *
     * @Route("/collection/add/{setCode}/{collectionId}")
     */
    public function addCardToCollection($setCode, $collectionId)
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();

        var_dump($user);die();
    }
}
