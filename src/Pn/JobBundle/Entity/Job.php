<?php

namespace Pn\JobBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Job
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Pn\PagesBundle\Entity\JobRepository")
 */
class Job
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="string", length=255)
     */
    private $latitude;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="decimal")
     */
    private $longitude;

    /**
     * @var string
     *
     * @ORM\Column(name="publication_status", type="string", length=255)
     */
    private $publicationStatus;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publication_start", type="datetime")
     */
    private $publicationStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publication_end", type="datetime")
     */
    private $publicationEnd;

    /**
     * @var string
     *
     * @ORM\Column(name="hourly_rate", type="decimal")
     */
    private $hourlyRate;

    /**
     * @var string
     *
     * @ORM\Column(name="duration", type="string", length=255)
     */
    private $duration;

    /**
     * @var string
     *
     * @ORM\Column(name="minimum_experience", type="string", length=255)
     */
    private $minimumExperience;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_date", type="datetime")
     */
    private $startDate;

    /**
     * @var array
     *
     * @ORM\Column(name="preferences", type="array")
     */
    private $preferences;

    /**
     * @var array
     *
     * @ORM\Column(name="extratasks", type="array")
     */
    private $extratasks;

    /**
     * @var array
     *
     * @ORM\Column(name="specialdemands", type="array")
     */
    private $specialdemands;


    /**
     * @ORM\ManyToMany(targetEntity="Pn\JobBundle\Entity\Child", cascade={"persist"})
     */
    private $children;

    /**
     * @ORM\ManyToOne(targetEntity="Pn\CoreBundle\Entity\Babysitter")
     */
    private $babysitter;











    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Job
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
     * Set status
     *
     * @param string $status
     * @return Job
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
     * Set description
     *
     * @param string $description
     * @return Job
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Job
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     * @return Job
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     * @return Job
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string 
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set publicationStatus
     *
     * @param string $publicationStatus
     * @return Job
     */
    public function setPublicationStatus($publicationStatus)
    {
        $this->publicationStatus = $publicationStatus;

        return $this;
    }

    /**
     * Get publicationStatus
     *
     * @return string 
     */
    public function getPublicationStatus()
    {
        return $this->publicationStatus;
    }

    /**
     * Set publicationStart
     *
     * @param \DateTime $publicationStart
     * @return Job
     */
    public function setPublicationStart($publicationStart)
    {
        $this->publicationStart = $publicationStart;

        return $this;
    }

    /**
     * Get publicationStart
     *
     * @return \DateTime 
     */
    public function getPublicationStart()
    {
        return $this->publicationStart;
    }

    /**
     * Set publicationEnd
     *
     * @param \DateTime $publicationEnd
     * @return Job
     */
    public function setPublicationEnd($publicationEnd)
    {
        $this->publicationEnd = $publicationEnd;

        return $this;
    }

    /**
     * Get publicationEnd
     *
     * @return \DateTime 
     */
    public function getPublicationEnd()
    {
        return $this->publicationEnd;
    }

    /**
     * Set hourlyRate
     *
     * @param string $hourlyRate
     * @return Job
     */
    public function setHourlyRate($hourlyRate)
    {
        $this->hourlyRate = $hourlyRate;

        return $this;
    }

    /**
     * Get hourlyRate
     *
     * @return string 
     */
    public function getHourlyRate()
    {
        return $this->hourlyRate;
    }

    /**
     * Set duration
     *
     * @param string $duration
     * @return Job
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return string 
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set minimumExperience
     *
     * @param string $minimumExperience
     * @return Job
     */
    public function setMinimumExperience($minimumExperience)
    {
        $this->minimumExperience = $minimumExperience;

        return $this;
    }

    /**
     * Get minimumExperience
     *
     * @return string 
     */
    public function getMinimumExperience()
    {
        return $this->minimumExperience;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return Job
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime 
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set preferences
     *
     * @param array $preferences
     * @return Job
     */
    public function setPreferences($preferences)
    {
        $this->preferences = $preferences;

        return $this;
    }

    /**
     * Get preferences
     *
     * @return array 
     */
    public function getPreferences()
    {
        return $this->preferences;
    }

    /**
     * Set extratasks
     *
     * @param array $extratasks
     * @return Job
     */
    public function setExtratasks($extratasks)
    {
        $this->extratasks = $extratasks;

        return $this;
    }

    /**
     * Get extratasks
     *
     * @return array 
     */
    public function getExtratasks()
    {
        return $this->extratasks;
    }

    /**
     * Set specialdemands
     *
     * @param array $specialdemands
     * @return Job
     */
    public function setSpecialdemands($specialdemands)
    {
        $this->specialdemands = $specialdemands;

        return $this;
    }

    /**
     * Get specialdemands
     *
     * @return array 
     */
    public function getSpecialdemands()
    {
        return $this->specialdemands;
    }

    /**
     * Add children
     *
     * @param \Pn\JobBundle\Entity\Child $children
     * @return Job
     */
    public function addChild(\Pn\JobBundle\Entity\Child $children)
    {
        $this->children[] = $children;

        return $this;
    }

    /**
     * Remove children
     *
     * @param \Pn\JobBundle\Entity\Child $children
     */
    public function removeChild(\Pn\JobBundle\Entity\Child $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set babysitter
     *
     * @param \Pn\CoreBundle\Entity\Babysitter $babysitter
     * @return Job
     */
    public function setBabysitter(\Pn\CoreBundle\Entity\Babysitter $babysitter = null)
    {
        $this->babysitter = $babysitter;

        return $this;
    }

    /**
     * Get babysitter
     *
     * @return \Pn\CoreBundle\Entity\Babysitter 
     */
    public function getBabysitter()
    {
        return $this->babysitter;
    }
}
