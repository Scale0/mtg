<?php

namespace F1Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Constructor
 *
 * @ORM\Table(name="constructor")
 * @ORM\Entity(repositoryClass="F1Bundle\Repository\ConstructorRepository")
 */
class Constructor
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
    private $constructorId;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $nationality;

    /**
     * @ORM\ManyToOne(targetEntity="Engine")
     */
    private $engine;

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
    public function getConstructorId()
    {
        return $this->constructorId;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * @return Engine
     */
    public function getEngine()
    {
        return $this->engine;
    }

    #endregion

    #region setters

    /**
     * @param mixed $constructorId
     * @return $this
     */
    public function setConstructorId($constructorId)
    {
        $this->constructorId = $constructorId;

        return $this;
    }

    /**
     * @param mixed $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

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
     * @param Engine $engine
     * @return $this
     */
    public function setEngine($engine)
    {
        $this->engine = $engine;

        return $this;
    }

    #endregion
}

