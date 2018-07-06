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

        $threads = '';
        if ($user == $this->getUser()) {
            $provider = $this->get('fos_message.provider');

            $threads = $provider->getInboxThreads();
        }
        if ($this->getUser()) {
            #die('ingelogd, maar niet op eigen profiel');
        }

        return $this->render('MtgBundle:User:profile.html.twig',
            [
                'collectionRows' => $collection,
                'decks' => $decks,
                'profileUser' => $user,
                'threads' => $threads
            ]);
    }

    /**
     * @Route("/user")
     */
    public function loggedInProfile()
    {
        $sjoerd2 = $this->getDoctrine()->getRepository('MtgBundle:User')->findOneBy(['username' => 'sjoerd2']);
        $messageComposer = $this->get('fos_message.composer');
        $message = $messageComposer->newThread()
            ->setSubject('test' . time())
            ->addRecipient($this->getUser())
            ->setSender($sjoerd2)
            ->setBody('This is a test message')
            ->getMessage();

        $messageSender = $this->get('fos_message.sender');

        $messageSender->send($message);
        $provider = $this->get('fos_message.provider');
        $inbox = $provider->getNbUnreadMessages();

        dump($inbox);die();
    }

}