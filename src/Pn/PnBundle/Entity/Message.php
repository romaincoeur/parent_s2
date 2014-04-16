<?php

namespace Pn\PnBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 */
class Message
{
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
     * @var \Pn\PnBundle\Entity\User
     */
    private $sender;

    /**
     * @var \Pn\PnBundle\Entity\User
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
     * @return Message
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
     * @return Message
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
     * @return Message
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
     * Set sender
     *
     * @param \Pn\PnBundle\Entity\User $sender
     * @return Message
     */
    public function setSender(\Pn\PnBundle\Entity\User $sender = null)
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * Get sender
     *
     * @return \Pn\PnBundle\Entity\User
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Set receiver
     *
     * @param \Pn\PnBundle\Entity\User $receiver
     * @return Message
     */
    public function setReceiver(\Pn\PnBundle\Entity\User $receiver = null)
    {
        $this->receiver = $receiver;

        return $this;
    }

    /**
     * Get receiver
     *
     * @return \Pn\PnBundle\Entity\User
     */
    public function getReceiver()
    {
        return $this->receiver;
    }
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
    /**
     * @var boolean
     */
    private $read;


    /**
     * Set read
     *
     * @param boolean $read
     * @return Message
     */
    public function setRead($read)
    {
        $this->read = $read;

        return $this;
    }

    /**
     * Get read
     *
     * @return boolean 
     */
    public function getRead()
    {
        return $this->read;
    }
    /**
     * @var boolean
     */
    private $is_read;


    /**
     * Set is_read
     *
     * @param boolean $isRead
     * @return Message
     */
    public function setIsRead($isRead)
    {
        $this->is_read = $isRead;

        return $this;
    }

    /**
     * Get is_read
     *
     * @return boolean 
     */
    public function getIsRead()
    {
        return $this->is_read;
    }

    /**
     * @ORM\PrePersist
     */
    public function setIsReadValue()
    {
        if(!$this->getIsRead())
        {
            $this->is_read = false;
        }
    }
}
