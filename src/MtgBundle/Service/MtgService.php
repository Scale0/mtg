<?php

namespace MtgBundle\Service;

use Doctrine\ORM\EntityManager;

class MtgService
{
    /**
     * @var EntityManager
     */
    protected $em;
    public function __construct(EntityManager $entityManager) {
        $this->em = $entityManager;
    }


    protected function getResultsFromUrl($url, $assoc = false)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        CURL_SETOPT($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        return json_decode($result, $assoc);
    }
}