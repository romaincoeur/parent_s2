<?php

namespace Pn\PnBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pparent
 */
class Pparent
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $nbChildren;

    /**
     * @var integer
     */
    private $trustpoints;

    /**
     * @var string
     */
    private $calendar;

    /**
     * @var \Pn\PnBundle\Entity\User
     */
    private $user;


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
     * Set nbChildren
     *
     * @param integer $nbChildren
     * @return Pparent
     */
    public function setNbChildren($nbChildren)
    {
        $this->nbChildren = $nbChildren;

        return $this;
    }

    /**
     * Get nbChildren
     *
     * @return integer 
     */
    public function getNbChildren()
    {
        return $this->nbChildren;
    }

    /**
     * Set trustpoints
     *
     * @param integer $trustpoints
     * @return Pparent
     */
    public function setTrustpoints($trustpoints)
    {
        $this->trustpoints = $trustpoints;

        return $this;
    }

    /**
     * Get trustpoints
     *
     * @return integer 
     */
    public function getTrustpoints()
    {
        return $this->trustpoints;
    }

    /**
     * Set calendar
     *
     * @param string $calendar
     * @return Pparent
     */
    public function setCalendar($calendar)
    {
        $this->calendar = $calendar;

        return $this;
    }

    /**
     * Get calendar
     *
     * @return string 
     */
    public function getCalendar()
    {
        return $this->calendar;
    }

    /**
     * Set user
     *
     * @param \Pn\PnBundle\Entity\User $user
     * @return Pparent
     */
    public function setUser(\Pn\PnBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Pn\PnBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * @ORM\PrePersist
     */
    public function setDefaultValues()
    {
        // Add your code here
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $jobs;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->jobs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add jobs
     *
     * @param \Pn\PnBundle\Entity\job $jobs
     * @return Pparent
     */
    public function addJob(\Pn\PnBundle\Entity\job $jobs)
    {
        $this->jobs[] = $jobs;

        return $this;
    }

    /**
     * Remove jobs
     *
     * @param \Pn\PnBundle\Entity\job $jobs
     */
    public function removeJob(\Pn\PnBundle\Entity\job $jobs)
    {
        $this->jobs->removeElement($jobs);
    }

    /**
     * Get jobs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getJobs()
    {
        return $this->jobs;
    }

    public function __toString()
    {
        return $this->getUser()->getHiddenName();
    }
}
