<?php

namespace Pn\PnBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Babysittercategory
 */
class Babysittercategory
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $babysitters;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $jobs;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->babysitters = new \Doctrine\Common\Collections\ArrayCollection();
        $this->jobs = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set title
     *
     * @param string $title
     * @return Babysittercategory
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Add babysitters
     *
     * @param \Pn\PnBundle\Entity\Babysitter $babysitters
     * @return Babysittercategory
     */
    public function addBabysitter(\Pn\PnBundle\Entity\Babysitter $babysitters)
    {
        $this->babysitters[] = $babysitters;

        return $this;
    }

    /**
     * Remove babysitters
     *
     * @param \Pn\PnBundle\Entity\Babysitter $babysitters
     */
    public function removeBabysitter(\Pn\PnBundle\Entity\Babysitter $babysitters)
    {
        $this->babysitters->removeElement($babysitters);
    }

    /**
     * Get babysitters
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBabysitters()
    {
        return $this->babysitters;
    }

    /**
     * Add jobs
     *
     * @param \Pn\PnBundle\Entity\Job $jobs
     * @return Babysittercategory
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

    public function __toString()
    {
        return $this->getTitle();
    }
}
