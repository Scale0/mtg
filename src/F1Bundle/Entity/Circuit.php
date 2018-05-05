<?php

namespace F1Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Circuit
 *
 * @ORM\Table(name="circuit")
 * @ORM\Entity(repositoryClass="F1Bundle\Repository\CircuitRepository")
 */
class Circuit
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
     * @ORM\Column(type="string")
     */
    private $circuitId;

    /**
     * @ORM\Column(type="string")
     */
    private $circuitName;

    /**
     * @ORM\Column(type="string")
     */
    private $locality;

    /**
     * @ORM\Column(type="string")
     */
    private $country;

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
    public function getCircuitId()
    {
        return $this->circuitId;
    }

    /**
     * @return mixed
     */
    public function getCircuitName()
    {
        return $this->circuitName;
    }

    /**
     * @return mixed
     */
    public function getLocality()
    {
        return $this->locality;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }
    #endregion

    #region setters
    /**
     * @param mixed $circuitId
     * @return $this
     */
    public function setCircuitId($circuitId)
    {
        $this->circuitId = $circuitId;

        return $this;
    }

    /**
     * @param mixed $circuitName
     * @return $this
     */
    public function setCircuitName($circuitName)
    {
        $this->circuitName = $circuitName;

        return $this;
    }

    /**
     * @param mixed $locality
     * @return $this
     */
    public function setLocality($locality)
    {
        $this->locality = $locality;

        return $this;
    }

    /**
     * @param mixed $country
     * @return $this
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }
    #endregion
}

