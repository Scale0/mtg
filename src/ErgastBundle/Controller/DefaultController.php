<?php

namespace ErgastBundle\Controller;

use F1Bundle\Entity\Driver;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('ErgastBundle:Default:index.html.twig');
    }

    public function getDrivers()
    {
        $result = $this->getResultsFromUrl("http://ergast.com/api/f1/current/drivers.json");

        $em = $this->getDoctrine()->getManager();
        foreach($result->MRData->DriverTable->Drivers as $newDriver){
            $existingDriver = $em->getRepository('F1Bundle:Driver')->findOneByCode($newDriver->code);
            if ($existingDriver != null) {
                break;
            }
            $driver = new Driver();
            $driver
                ->setCode($newDriver->code)
                ->setDriverId($newDriver->driverId)
                ->setPermanentNumber(!empty($newDriver->permanentNumber) ? $newDriver->permanentNumber : 0)
                ->setFirstName($newDriver->givenName)
                ->setLastName($newDriver->familyName)
                ->setDateOfBirth(new \DateTime($newDriver->dateOfBirth))
                ->setNationality($newDriver->nationality);

            echo $driver->getFirstName() . " " . $driver->getLastName() . "<br />";
            $em->persist($driver);
        }
        $em->flush();
    }


    private function getResultsFromUrl($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        CURL_SETOPT($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        return json_decode($result);
    }
}
