<?php

namespace Pn\PnBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Recommendation
 */
class Recommendation
{


    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        if(!$this->getCreatedAt())
        {
            $this->created_at = new \DateTime();
        }
    }
















    // GENERATED CODE

    
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $body;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     */
    private $giver;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     */
    private $receiver;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Recommendation
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set body
     *
     * @param string $body
     * @return Recommendation
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string 
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Recommendation
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set giver
     *
     * @param \Application\Sonata\UserBundle\Entity\User $giver
     * @return Recommendation
     */
    public function setGiver(\Application\Sonata\UserBundle\Entity\User $giver = null)
    {
        $this->giver = $giver;

        return $this;
    }

    /**
     * Get giver
     *
     * @return \Application\Sonata\UserBundle\Entity\User 
     */
    public function getGiver()
    {
        return $this->giver;
    }

    /**
     * Set receiver
     *
     * @param \Application\Sonata\UserBundle\Entity\User $receiver
     * @return Recommendation
     */
    public function setReceiver(\Application\Sonata\UserBundle\Entity\User $receiver = null)
    {
        $this->receiver = $receiver;

        return $this;
    }

    /**
     * Get receiver
     *
     * @return \Application\Sonata\UserBundle\Entity\User 
     */
    public function getReceiver()
    {
        return $this->receiver;
    }
}
