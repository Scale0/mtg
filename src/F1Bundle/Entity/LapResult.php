<?php

namespace F1Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LapResult
 *
 * @ORM\Table(name="lap_result")
 * @ORM\Entity(repositoryClass="F1Bundle\Repository\LapResultRepository")
 */
class LapResult
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
     * @ORM\ManyToOne(targetEntity="Race")
     */
    private $race;

    /**
     * @ORM\Column(type="integer")
     */
    private $lap;

    /**
     * @ORM\ManyToOne(targetEntity="Driver")
     */
    private $driver;

    /**
     * @ORM\Column(type="integer")
     */
    private $position;

    /**
     * @ORM\Column(type="string")
     */
    private $time;

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
     * @return Race
     */
    public function getRace()
    {
        return $this->race;
    }

    /**
     * @return integer
     */
    public function getLap()
    {
        return $this->lap;
    }


    /**
     * @return Driver
     */
    public function getDriver()
    {
        return $this->driver;
    }

    /**
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @return string
     */
    public function getTime()
    {
        return $this->time;
    }
    #endregion

    #region setters
    /**
     * @param Race $race
     *
     * @return $this
     */
    public function setRace($race)
    {
        $this->race = $race;

        return $this;
    }

    /**
     * @param mixed $lap
     *
     * @return $this
     */
    public function setLap($lap)
    {
        $this->lap = $lap;

        return $this;
    }

    /**
     * @param Driver $driver
     *
     * @return $this
     */
    public function setDriver($driver)
    {
        $this->driver = $driver;

        return $this;
    }

    /**
     * @param integer $position
     *
     * @return $this
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * @param string $time
     *
     * @return $this
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    #endregion
}

