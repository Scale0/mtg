<?php
namespace MtgBundle\Controller;

use FOS\MessageBundle\Composer\Composer;
use FOS\MessageBundle\Provider\Provider;
use FOS\MessageBundle\Sender\Sender;
use MtgBundle\Service\MtgCollectionService;
use MtgBundle\Service\MtgDeckService;
use MtgBundle\Service\MtgUserService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    private $userService;
    private $deckService;
    private $collectionService;
    private $messageProvider;
    private $messageComposer;
    private $messageSender;
    public function __construct(
        MtgUserService $userService,
        MtgDeckService $deckService,
        MtgCollectionService $collectionService,
        Provider $messageProvider,
        Composer $messageComposer,
        Sender $messageSender
    )
    {
        $this->userService = $userService;
        $this->deckService = $deckService;
        $this->collectionService = $collectionService;
        $this->messageProvider = $messageProvider;
        $this->messageComposer = $messageComposer;
        $this->messageSender = $messageComposer;
    }
    /**
     * @param $userName
     * @Route("/profile/{userName}")
     */
    public function profile($userName)
    {
        $user = $this->userService->getUserByUserName($userName);
        $decks = $this->deckService->getDecks($user);
        $collection = $this->collectionService->getByUser($user);

        $threads = '';
        if ($user == $this->getUser()) {
            $threads = $this->messageProvider->getInboxThreads();
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

        $message = $this->messageComposer->newThread()
            ->setSubject('test' . time())
            ->addRecipient($this->getUser())
            ->setSender($sjoerd2)
            ->setBody('This is a test message')
            ->getMessage();

        $this->messageSender->send($message);
        $inbox = $this->messageProvider->getNbUnreadMessages();

        dump($inbox);die();
    }

}