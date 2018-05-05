<?php

namespace F1Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Race
 *
 * @ORM\Table(name="race")
 * @ORM\Entity(repositoryClass="F1Bundle\Repository\RaceRepository")
 */
class Race
{
    #region keys
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="time")
     */
    private $time;

    /**
     * @ORM\ManyToOne(targetEntity="Season")
     */
    private $season;

    /**
     * @ORM\ManyToOne(targetEntity="Circuit")
     */
    private $circuit;

    /**
     * @ORM\Column(type="integer")
     */
    private $round;

    #endregion

    #region getters
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @return Season
     */
    public function getSeason()
    {
        return $this->season;
    }

    /**
     * @return Circuit
     */
    public function getCircuit()
    {
        return $this->circuit;
    }

    /**
     * @return mixed
     */
    public function getRound()
    {
        return $this->round;
    }
    #endregion

    #region setters
    /**
     * @param mixed $date
     * @return $this
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @param mixed $time
     * @return $this
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * @param Season $season
     * @return $this
     */
    public function setSeason(Season $season)
    {
        $this->season = $season;

        return $this;
    }

    /**
     * @param Circuit $circuit
     * @return $this
     */
    public function setCircuit(Circuit $circuit)
    {
        $this->circuit = $circuit;

        return $this;
    }

    /**
     * @param $round
     * @return $this
     */
    public function setRound($round)
    {
        $this->round = $round;

        return $this;
    }

    #endregion

}

