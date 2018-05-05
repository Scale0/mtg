<?php

namespace F1Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Season
 *
 * @ORM\Table(name="season")
 * @ORM\Entity(repositoryClass="F1Bundle\Repository\SeasonRepository")
 */
class Season
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
     * @ORM\Column(type="integer")
     */
    private $season;

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
    public function getSeason()
    {
        return $this->season;
    }

    #endregion

    #region setters

    /**
     * @param mixed $season
     * @return $this;
     */
    public function setSeason($season)
    {
        $this->season = $season;

        return $this;
    }
    #endregion

}

