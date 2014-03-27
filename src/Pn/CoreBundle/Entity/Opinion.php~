<?php

namespace Pn\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Opinion
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Pn\CoreBundle\Entity\OpinionRepository")
 */
class Opinion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var integer
     *
     * @ORM\Column(name="rate", type="integer")
     */
    private $rate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="Pn\UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $giver;

    /**
     * @ORM\ManyToOne(targetEntity="Pn\UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
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
     * Set content
     *
     * @param string $content
     * @return Opinion
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set rate
     *
     * @param integer $rate
     * @return Opinion
     */
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate
     *
     * @return integer 
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Opinion
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set giver
     *
     * @param \Pn\UserBundle\Entity\User $giver
     * @return Opinion
     */
    public function setGiver(\Pn\UserBundle\Entity\User $giver)
    {
        $this->giver = $giver;

        return $this;
    }

    /**
     * Get giver
     *
     * @return \Pn\UserBundle\Entity\User 
     */
    public function getGiver()
    {
        return $this->giver;
    }

    /**
     * Set receiver
     *
     * @param \Pn\UserBundle\Entity\User $receiver
     * @return Opinion
     */
    public function setReceiver(\Pn\UserBundle\Entity\User $receiver)
    {
        $this->receiver = $receiver;

        return $this;
    }

    /**
     * Get receiver
     *
     * @return \Pn\UserBundle\Entity\User 
     */
    public function getReceiver()
    {
        return $this->receiver;
    }
}
