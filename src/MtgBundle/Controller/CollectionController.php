<?php

namespace MtgBundle\Controller;

use MtgBundle\Form\CardCollection\massCardCollectionType;
use MtgBundle\Service\MtgCardService;
use MtgBundle\Service\MtgCollectionService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class CollectionController extends Controller
{

    private $collectionService;
    private $cardService;
    public function __construct(
        MtgCollectionService $collectionService,
        MtgCardService $cardService
    )
    {
        $this->collectionService = $collectionService;
        $this->cardService = $cardService;
    }
    /**
     * @param $setCode
     * @param $collectionId
     *
     * @Route("/collection/add/{setCode}/{collectionId}")
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function addCardToCollection($setCode, $collectionId)
    {
        $card = $this->cardService
            ->get($setCode, $collectionId)
        ;
        $user = $this->container->get('security.token_storage')
            ->getToken()
            ->getUser()
        ;

        $this->collectionService->addCardToCollection($card, $user);

        return $this->redirectToRoute('mtg_collection_getcollection');
    }

    /**
     * @Route("/collection/massAdd")
     */
    public function massAddToCollection(Request $request)
    {
        $form = $this->createForm(massCardCollectionType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cardSet = $form->getData()['set'];
            $cardString = $form->getData()['string'];
            $cardArray = str_split($cardString, 3);

            $this->collectionService
                ->addArrayToCollection($cardSet, $cardArray, $this->getUser());
            return $this->redirectToRoute('mtg_collection_getcollection');
        }

        return $this->render('MtgBundle:Collection:create.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @param $collectionId
     * @Route("/collection/del/{collectionId}")
     */
    public function removeFromCollection($collectionId)
    {
        $collectionRow = $this->collectionService->get($collectionId);
        $user = $this->getUser();
        $this->collectionService->removeCardFromCollection($collectionRow, $user);

        return $this->redirectToRoute('mtg_collection_getcollection');
    }

    /**
     * @return mixed
     * @Route("/collection")
     */
    public function getCollection()
    {
        $collectionRows = $this->collectionService->getRows($this->getUser());

        return $this->render('MtgBundle:Collection:collection.html.twig', ['collectionRows' => $collectionRows]);
    }

    /**
     * @return string
     * @Route("/collection/export")
     */
    public function exportCollection()
    {
        $collection = $this->collectionService->getCollectionByUserOrderedBySet($this->getUser());
        $currentSet = '';

        $out = '';

        foreach($collection as $collectionRow) {
            if ($currentSet != $collectionRow->getCard()->getCardSet()->getCode()) {
                $currentSet = $collectionRow->getCard()->getCardSet()->getCode();
                $out .= "<br />" . $currentSet . "<br />";
            }
            for($i = 0; $i <= $collectionRow->getAmount(); $i++) {
                $out .= str_pad($collectionRow->getCard()->getCollectionId(), 3, '0', STR_PAD_LEFT);
            }
        }

        return new Response($out);
    }
}
