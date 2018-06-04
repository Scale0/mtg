<?php

namespace MtgBundle\Service;

class MtgRulingService extends MtgService
{
    public function get($card)
    {
        $existingRule = $this->em->getRepository('MtgBundle:Ruling')
            ->findOneBy(['card' => $card]);


        if ($existingRule && $existingRule->getUpdateDate()) {
            return $existingRule;
        }
    }
}