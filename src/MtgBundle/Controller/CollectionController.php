<?php

namespace MtgBundle\Controller;

use MtgBundle\Entity\Collection;
use MtgBundle\Form\CollectionType;
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
    }

    /**
     * @Route("/collection/create")
     */
    public function createCollection()
    {
        $collection = new Collection();
        $form = $this->createForm(CollectionType::class, $collection);

    }
}
