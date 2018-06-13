<?php

namespace MtgBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CardCollection
 *
 * @ORM\Table(name="card_collection")
 * @ORM\Entity(repositoryClass="MtgBundle\Repository\CardCollectionRepository")
 */
class CardCollection
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="MtgBundle\Entity\User")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="MtgBundle\Entity\Card")
     */
    private $card;

    /**
     * @ORM\Column(type="integer")
     */
    private $amount = 1;
    #region setters
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
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return Card
     */
    public function getCard()
    {
        return $this->card;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function addOne()
    {
        $this->amount++;
    }

    public function removeOne()
    {
        $this->amount--;
    }

    #endregion

    #region setters

    /**
     * @param User $user
     *
     * @return $this
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @param Card $card
     *
     * @return $this
     */
    public function setCard($card)
    {
        $this->card = $card;

        return $this;
    }
    #endregion

}

