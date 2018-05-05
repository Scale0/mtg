<?php

namespace F1Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Driver
 *
 * @ORM\Table(name="driver")
 * @ORM\Entity(repositoryClass="F1Bundle\Repository\DriverRepository")
 */
class Driver
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
    private $FirstName;

    /**
     * @ORM\Column(type="string")
     */
    private $lastName;

    /**
     * @ORM\Column(type="string")
     */
    private $code;

    /**
     * @ORM\Column(type="integer")
     */
    private $permanentNumber;

    /**
     * @ORM\Column(type="string")
     */
    private $nationality;

    /**
     * @ORM\Column(type="date")
     */
    private $dateOfBirth;

    /**
     * @ORM\Column(type="string")
     */
    private $driverId;

    /**
     * @ORM\ManyToOne(targetEntity="Constructor")
     */
    private $constructor;
    #endregion

    #region getters
    /**
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
    public function getFirstName()
    {
        return $this->FirstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return mixed
     */
    public function getPermanentNumber()
    {
        return $this->permanentNumber;
    }

    /**
     * @return mixed
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * @return mixed
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * @return mixed
     */
    public function getDriverId()
    {
        return $this->driverId;
    }

    /**
     * @return mixed
     */
    public function getConstructor()
    {
        return $this->constructor;
    }

    #endregion

    #region setters
    /**
     * @param mixed $FirstName
     * @return $this
     */
    public function setFirstName($FirstName)
    {
        $this->FirstName = $FirstName;

        return $this;
    }

    /**
     * @param mixed $lastName
     * @return $this
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @param mixed $code
     * @return $this
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @param mixed $permanentNumber
     * @return $this
     */
    public function setPermanentNumber($permanentNumber)
    {
        $this->permanentNumber = $permanentNumber;

        return $this;
    }

    /**
     * @param mixed $nationality
     * @return $this
     */
    public function setNationality($nationality)
    {
        $this->nationality = $nationality;

        return $this;
    }

    /**
     * @param /Date $dateOfBirth
     * @return $this
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    /**
     * @param mixed $driverId
     * @return $this
     */
    public function setDriverId($driverId)
    {
        $this->driverId = $driverId;

        return $this;
    }

    /**
     * @param Constructor $constructor
     * @return $this
     */
    public function setConstructor(Constructor $constructor)
    {
        $this->constructor = $constructor;

        return $this;
    }


    #endregion

}

