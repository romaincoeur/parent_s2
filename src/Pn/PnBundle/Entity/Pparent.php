<?php

namespace Pn\PnBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pparent
 */
class Pparent
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->jobs = new \Doctrine\Common\Collections\ArrayCollection();
    }


    public function __toString()
    {
        if ($this->getUser() != null)
            return $this->getUser()->getHiddenName();
        else
            return null;
    }

    public function getCurrentJob()
    {
        return $this->jobs->last();
    }





























    // GENERATED CODE


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
     * @var \Application\Sonata\UserBundle\Entity\User
     */
    private $user;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $jobs;


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
     * @param \Application\Sonata\UserBundle\Entity\User $user
     * @return Pparent
     */
    public function setUser(\Application\Sonata\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Application\Sonata\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add jobs
     *
     * @param \Pn\PnBundle\Entity\Job $jobs
     * @return Pparent
     */
    public function addJob(\Pn\PnBundle\Entity\Job $jobs)
    {
        $this->jobs[] = $jobs;

        return $this;
    }

    /**
     * Remove jobs
     *
     * @param \Pn\PnBundle\Entity\Job $jobs
     */
    public function removeJob(\Pn\PnBundle\Entity\Job $jobs)
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
    /**
     * @ORM\PrePersist
     */
    public function setDefaultValues()
    {
        // Add your code here
    }
}
