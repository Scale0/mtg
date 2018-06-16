<?php
namespace MtgBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    /**
     * @param $userName
     * @Route("/profile/{userName}")
     */
    public function profile($userName)
    {
        $user = $this->get('mtg.user')->getUserByUserName($userName);
        $decks = $this->get('mtg.deck')->getDecks($user);
        $collection = $this->get('mtg.collection')->getByUser($user);
        return $this->render('MtgBundle:User:profile.html.twig', ['collectionRows' => $collection, 'decks' => $decks]);
    }

}