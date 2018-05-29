<?php

namespace MtgBundle\Controller;

use MtgBundle\Form\CardCollection\massCardCollectionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CollectionController extends Controller
{
    /**
     * @param $setCode
     * @param $collectionId
     *
     * @Route("/collection/add/{setCode}/{collectionId}")
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function addCardToCollection($setCode, $collectionId)
    {
        $collection = $this->get('mtg.collection');

        $card = $this->get('mtg.card')
            ->get($setCode, $collectionId)
        ;
        $user = $this->container->get('security.token_storage')
            ->getToken()
            ->getUser()
        ;

        $collection->addCardToCollection($card, $user);

        return $this->getCollection();
    }

    /**
     * @Route("/collection/create")
     */
    public function createCollection(Request $request)
    {
        $form = $this->createForm(massCardCollectionType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cardSet = $form->getData()['set'];
            $cardString = $form->getData()['name'];
            $cardArray = str_split($cardString, 3);

            $this->get('mtg.collection')
                ->addArrayToCollection($cardSet, $cardArray, $this->getUser());
        }

        return $this->render('MtgBundle:Collection:create.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @param $collectionId
     * @Route("/collection/del/{collectionId}")
     */
    public function removeFromCollection($collectionId)
    {
        $collectionRow = $this->get('mtg.collection')->get($collectionId);
        $user = $this->getUser();
        $this->get('mtg.collection')->removeCardFromCollection($collectionRow, $user);

        return $this->getCollection();
    }

    /**
     * @return mixed
     * @Route("/collection")
     */
    public function getCollection()
    {
        $collectionRows = $this->get('mtg.collection')->getRows($this->getUser());

        return $this->render('MtgBundle:Collection:collection.html.twig', ['collectionRows' => $collectionRows]);
    }
}
