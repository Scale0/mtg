<?php

namespace F1Bundle\Controller;

use F1Bundle\Entity\Circuit;
use F1Bundle\Entity\Constructor;
use F1Bundle\Entity\Driver;
use F1Bundle\Entity\LapResult;
use F1Bundle\Entity\Race;
use F1Bundle\Entity\RaceResult;
use F1Bundle\Entity\Season;
use F1Bundle\Repository\DriverRepository;
use F1Bundle\Repository\ConstructorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints\Date;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('F1Bundle:Default:index.html.twig');
    }

    /**
     * @route("/show");
     */
    public function showData()
    {
        echo "he ho! lets go!";die();
    }

    /**
     * @route("/getDrivers")
     */
    public function getDriversAction()
    {

        $result = $this->getResultsFromUrl("http://ergast.com/api/f1/current/drivers.json");

        $em = $this->getDoctrine()->getManager();
        foreach($result->MRData->DriverTable->Drivers as $newDriver){
            $existingDriver = $em->getRepository('F1Bundle:Driver')
                ->findOneByCode($newDriver->code);
            if ($existingDriver) {
                continue;
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
        die('jeej!');
    }

    /**
     * @route("/getConstructors")
     */
    public function getConstructorsAction()
    {
        $result = $this->getResultsFromUrl("http://ergast.com/api/f1/current/constructors.json");

        $em = $this->getDoctrine()->getManager();
        foreach($result->MRData->ConstructorTable->Constructors as $newConstructor) {
            $existingConstructor = $em->getRepository('F1Bundle:Constructor')
                ->findOneByConstructorId($newConstructor->constructorId);
            if ($existingConstructor) {
                continue;
            }
            $constructor = new Constructor();
            $constructor
                ->setConstructorId($newConstructor->constructorId)
                ->setName($newConstructor->name)
                ->setNationality($newConstructor->nationality);
            echo $constructor->getName() . " <br />";
            $em->persist($constructor);
        }
        $em->flush();

        $this->linkDriversToConstructor();

        die('constructors toegevoegd');
    }

    public function linkDriversToConstructor()
    {
        $em = $this->getDoctrine()->getManager();

        $constructors = $em->getRepository('F1Bundle:Constructor')->findAll();

        echo "<pre>";
        foreach($constructors as $constructor) {
            $constructorId = $constructor->getConstructorId();
            $result = $this->getResultsFromUrl("http://ergast.com/api/f1/current/constructors/".$constructorId."/drivers.json");
            $drivers = $result->MRData->DriverTable->Drivers;

            foreach($drivers as $unlinkedDriver)
            {
                $driver = $em->getRepository('F1Bundle:Driver')->findOneByCode($unlinkedDriver->code);
                $driver->setConstructor($constructor);
                $em->persist($driver);
            }
        }
        $em->flush();
    }

    /**
     * @Route("/getCircuits")
     */
    public function getCircuitsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $results = $this->getResultsFromUrl("http://ergast.com/api/f1/current/circuits.json");
        $circuits = $results->MRData->CircuitTable->Circuits;

        foreach($circuits as $newCircuit) {
            $existingCircuit = $em->getRepository('F1Bundle:Circuit')
                ->getByCircuitId($newCircuit->circuitId);
            if ($existingCircuit) {
                continue;
            }
            $circuit = new Circuit();
            $circuit->setCircuitId($newCircuit->circuitId)
                ->setCircuitName($newCircuit->circuitName)
                ->setCountry($newCircuit->Location->country)
                ->setLocality($newCircuit->Location->locality);
            $em->persist($circuit);
        }

        $em->flush();
        die("toegevoegd");

    }

    /**
     * @Route("/getSeason")
     */

    public function getSeasonAction()
    {
        $em = $this->getDoctrine()->getManager();
        $result = $this->getResultsFromUrl("http://ergast.com/api/f1/current/seasons.json");

        $seasons = $result->MRData->SeasonTable->Seasons;

        foreach($seasons as $newSeason) {
            $currentSeason = $em->getRepository('F1Bundle:Season')
                ->getBySeason($newSeason->season);
            if ($currentSeason) {
                die('no seasonchange');
                break;
            }
            $season = new Season();
            $season
                ->setSeason($newSeason->season);
            $em->persist($season);
            $em->flush();
            die('current season changed');
        }

    }

    /**
     * @Route("/getRaces")
     */
    public function getRacesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $result = $this->getResultsFromUrl("http://ergast.com/api/f1/current.json");

        $races = $result->MRData->RaceTable->Races;

        $season = $em->getRepository('F1Bundle:Season')
            ->getBySeason($result->MRData->RaceTable->season);
        foreach($races as $newRace) {
            $circuit = $em->getRepository('F1Bundle:Circuit')
                ->getByCircuitId($newRace->Circuit->circuitId);
            $existingRace = $em->getRepository('F1Bundle:Race')
                ->getBySeasonAndCircuit($season, $circuit);
            if ($existingRace) {
                continue;
            }

            $race = new Race();
            $race
                ->setSeason($season)
                ->setCircuit($circuit)
                ->setRound($newRace->round)
                ->setDate(new \DateTime($newRace->date))
                ->setTime(new \DateTime($newRace->time));
            $em->persist($race);

            $raceResults = $this->getResultsFromUrl("http://ergast.com/api/f1/current/" . $race->getRound() . "/results.json");

            $raceResults = $raceResults->MRData->RaceTable->Races[0]->Results;

            foreach ($raceResults as $newResult) {
                $fastestLap = !empty($newResult->FastestLap->Time->time) ? $newResult->FastestLap->Time->time : null;
                $driver = $em->getRepository('F1Bundle:Driver')
                    ->findOneByCode($newResult->Driver->code);
                $result = new RaceResult();
                $result
                    ->setDriver($driver)
                    ->setRace($race)
                    ->setStatus($newResult->status)
                    ->setFastestTime($fastestLap)
                    ->setFinishPosition($newResult->position)
                    ->setGridPosition($newResult->grid);
                $em->persist($result);
            }
        }
        $em->flush();

        die('RacesAdded');
    }

    /**
     * @param $seasonId
     * @param $round
     * @Route("/getRaceResults/{seasonId}/{round}")
     * @return
     */
    public function getRaceResultsAction($seasonId, $round)
    {
        $em = $this->getDoctrine()->getManager();
        $season = $em->getRepository('F1Bundle:Season')->getBySeason($seasonId);
        dump($season);
        if (!$season) {
            die('foutje!');
        }
        $race = $em->getRepository('F1Bundle:Race')->getBySeasonAndRound($season, $round);

        $raceResults = $em->getRepository('F1Bundle:RaceResult')->getResultsByRace($race);
        foreach($raceResults as $raceResult) {
            $lapResults = $this->getResultsFromUrl("http://ergast.com/api/f1/" . $season->getSeason() . "/" . $round . "/drivers/" . $raceResult->getDriver()->getDriverId() . "/laps.json?limit=100");

            $laps = $lapResults->MRData->RaceTable->Races[0]->Laps;
            foreach ($laps as $lap) {
                $newLap = new LapResult();
                $newLap
                    ->setRace($race)
                    ->setDriver($raceResult->getDriver())
                    ->setTime($lap->Timings[0]->time)
                    ->setPosition($lap->Timings[0]->position)
                    ->setLap($lap->number)
                ;
                $em->persist($newLap);

            }
        }
        $em->flush();
        die('Resultaten toegevoegd van ' . $seasonId . ' ' . $race->getCircuit()->getCircuitName());
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
