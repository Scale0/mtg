<?php

namespace MtgBundle\Controller;

use MtgBundle\Entity\Collection;
use MtgBundle\Form\CollectionType;
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

        $collectedCard = $collection->addCardToCollection($card, $user);

        var_dump($collectedCard);die();
    }

    /**
     * @Route("/collection/create")
     */
    public function createCollection(Request $request)
    {
        $collection = new Collection();
        $form = $this->createForm(CollectionType::class, $collection);
        $collection->setUser($this->getUser());

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('mtg.collection')
                ->saveCollection($collection)
            ;
        }

        return $this->render('MtgBundle:Collection:create.html.twig', ['form' => $form->createView()]);
    }
}
