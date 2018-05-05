<?php

namespace F1Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RaceResult
 *
 * @ORM\Table(name="race_result")
 * @ORM\Entity(repositoryClass="F1Bundle\Repository\RaceResultRepository")
 */
class RaceResult
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
     * @ORM\ManyToOne(targetEntity="Driver")
     */
    private $driver;

    /**
     * @ORM\ManyToOne(targetEntity="Race")
     */
    private $race;

    /**
     * @ORM\Column(type="integer")
     */
    private $gridPosition;

    /**
     * @ORM\Column(type="integer")
     */
    private $finishPosition;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $fastestTime;

    /**
     * @ORM\Column(type="string")
     */
    private $status;

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
     * @return Driver
     */
    public function getDriver()
    {
        return $this->driver;
    }

    /**
     * @return Race
     */
    public function getRace()
    {
        return $this->race;
    }

    /**
     * @return integer
     */
    public function getGridPosition()
    {
        return $this->gridPosition;
    }

    /**
     * @return integer
     */
    public function getFinishPosition()
    {
        return $this->finishPosition;
    }

    /**
     * @return mixed
     */
    public function getFastestTime()
    {
        return $this->fastestTime;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }
    #endregion

    #region setters

    /**
     * @param Driver $driver
     * @return $this
     */
    public function setDriver(Driver $driver)
    {
        $this->driver = $driver;

        return $this;
    }

    /**
     * @param Race $race
     * @return $this
     */
    public function setRace(Race $race)
    {
        $this->race = $race;
        return $this;
    }

    /**
     * @param integer $gridPosition
     * @return $this;
     */
    public function setGridPosition($gridPosition)
    {
        $this->gridPosition = $gridPosition;
    }

    /**
     * @param mixed $finishPosition
     * @return $this;
     */
    public function setFinishPosition($finishPosition)
    {
        $this->finishPosition = $finishPosition;

        return $this;
    }

    /**
     * @param mixed $fastestTime
     * @return $this
     */
    public function setFastestTime($fastestTime)
    {
        $this->fastestTime = $fastestTime;

        return $this;
    }

    /**
     * @param mixed $status
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    #endregion

}

