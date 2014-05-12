<?php

namespace Pn\PnBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Job
 */
class Job
{

    public function __construct()
    {
        $this->diplomas = array();
        $this->ageofchildren = array();
        $this->languages = array();
        $this->particularite = array();
        $this->extraTasks = array();
        $this->petitsplus = array();
    }


    /**
     * @ORM\PrePersist
     */
    public function setDefaultValues()
    {
        $this->setStatus('annonce');
        if ($this->getCategory() == null) $this->setCategory('nounou');
        if ($this->getExperience() == null) $this->setExperience(0);
        if ($this->getStart() == null) $this->setStart(new \DateTime());
        if ($this->getEnd() == null) $this->setEnd(new \DateTime());
        if ($this->calendar == null) $this->setCalendar('[(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)
        (0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)
        (0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)
        (0000000)(0000000)]');
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
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue()
    {
        $this->updated_at = new \DateTime();
    }

    public static function getStatuses()
    {
        return array('annonce' => 'Annonces', 'job' => 'Job', 'facture' => 'Facture');
    }

    public static function getStatusValues()
    {
        return array_keys(self::getStatuses());
    }
    /**
     * @var integer
     */
    private $experience;

    public function shortDescription($maxLength)
    {
        if (strlen($this->description) <= $maxLength)
            return $this->description;

        $result = substr($this->description, 0, $maxLength);
        return $result."...";
    }

    /**
     * @param string $diploma
     *
     * @return Job
     */
    public function addDiploma($diploma)
    {
        if (!$this->hasDiploma($diploma)) {
            $this->diplomas[] = $diploma;
        }

        return $this;
    }

    /**
     * @param string $diploma
     */
    public function hasDiploma($diploma)
    {
        return in_array($diploma, $this->diplomas, true);
    }

    /**
     * @param string $diploma
     *
     * @return Job
     */
    public function removeDiploma($diploma)
    {
        if (false !== $key = array_search($diploma, $this->diplomas, true)) {
            unset($this->diplomas[$key]);
            $this->diplomas = array_values($this->diplomas);
        }

        return $this;
    }

    /**
     * @param string $diploma
     *
     * @return Job
     */
    public function switchDiploma($diploma)
    {
        if ($this->hasDiploma($diploma)) {
            $this->removeDiploma($diploma);
        }
        else
        {
            $this->addDiploma($diploma);
        }

        return $this;
    }

    /**
     * @param string $age
     *
     * @return Job
     */
    public function addAgeOfChildren($age)
    {
        if (!$this->hasAgeOfChildren($age)) {
            $this->ageofchildren[] = $age;
        }

        return $this;
    }

    /**
     * @param string $age
     */
    public function hasAgeOfChildren($age)
    {
        return in_array($age, $this->ageofchildren, true);
    }

    /**
     * @param string $age
     *
     * @return Job
     */
    public function removeAgeOfChildren($age)
    {
        if (false !== $key = array_search($age, $this->ageofchildren, true)) {
            unset($this->ageofchildren[$key]);
            $this->ageofchildren = array_values($this->ageofchildren);
        }

        return $this;
    }

    /**
     * @param string $age
     *
     * @return Job
     */
    public function switchAgeOfChildren($age)
    {
        if ($this->hasAgeOfChildren($age)) {
            $this->removeAgeOfChildren($age);
        }
        else
        {
            $this->addAgeOfChildren($age);
        }

        return $this;
    }

    /**
     * @param string $language
     *
     * @return Job
     */
    public function addLanguage($language)
    {
        if (!$this->hasLanguage($language)) {
            $this->languages[] = $language;
        }

        return $this;
    }

    /**
     * @param string $language
     */
    public function hasLanguage($language)
    {
        return in_array($language, $this->languages, true);
    }

    /**
     * @param string $language
     *
     * @return Job
     */
    public function removeLanguage($language)
    {
        if (false !== $key = array_search($language, $this->languages, true)) {
            unset($this->languages[$key]);
            $this->languages = array_values($this->languages);
        }

        return $this;
    }

    /**
     * @param string $language
     *
     * @return Job
     */
    public function switchLanguage($language)
    {
        if ($this->hasLanguage($language)) {
            $this->removeLanguage($language);
        }
        else
        {
            $this->addLanguage($language);
        }

        return $this;
    }

    /**
     * @param string $particularite
     *
     * @return Job
     */
    public function addParticularite($particularite)
    {
        if (!$this->hasParticularite($particularite)) {
            $this->particularite[] = $particularite;
        }

        return $this;
    }

    /**
     * @param string $particularite
     */
    public function hasParticularite($particularite)
    {
        return in_array($particularite, $this->particularite, true);
    }

    /**
     * @param string $particularite
     *
     * @return Job
     */
    public function removeParticularite($particularite)
    {
        if (false !== $key = array_search($particularite, $this->particularite, true)) {
            unset($this->particularite[$key]);
            $this->particularite = array_values($this->particularite);
        }

        return $this;
    }

    /**
     * @param string $particularite
     *
     * @return Job
     */
    public function switchParticularite($particularite)
    {
        if ($this->hasParticularite($particularite)) {
            $this->removeParticularite($particularite);
        }
        else
        {
            $this->addParticularite($particularite);
        }

        return $this;
    }

    /**
     * @param string $extraTask
     *
     * @return Job
     */
    public function addExtraTask($extraTask)
    {
        if (!$this->hasExtraTask($extraTask)) {
            $this->extraTasks[] = $extraTask;
        }

        return $this;
    }

    /**
     * @param string $extraTask
     */
    public function hasExtraTask($extraTask)
    {
        return in_array($extraTask, $this->extraTasks, true);
    }

    /**
     * @param string $extraTask
     *
     * @return Job
     */
    public function removeExtraTask($extraTask)
    {
        if (false !== $key = array_search($extraTask, $this->extraTasks, true)) {
            unset($this->extraTasks[$key]);
            $this->extraTasks = array_values($this->extraTasks);
        }

        return $this;
    }

    /**
     * @param string $extraTask
     *
     * @return Job
     */
    public function switchExtraTask($extraTask)
    {
        if ($this->hasExtraTask($extraTask)) {
            $this->removeExtraTask($extraTask);
        }
        else
        {
            $this->addExtraTask($extraTask);
        }

        return $this;
    }

    /**
     * @param string $petitsPlus
     *
     * @return Job
     */
    public function addPetitsPlus($petitsPlus)
    {
        if (!$this->hasPetitsPlus($petitsPlus)) {
            $this->petitsplus[] = $petitsPlus;
        }

        return $this;
    }

    /**
     * @param string $petitsPlus
     */
    public function hasPetitsPlus($petitsPlus)
    {
        return in_array($petitsPlus, $this->petitsplus, true);
    }

    /**
     * @param string $petitsPlus
     *
     * @return Job
     */
    public function removePetitsPlus($petitsPlus)
    {
        if (false !== $key = array_search($petitsPlus, $this->petitsplus, true)) {
            unset($this->petitsplus[$key]);
            $this->petitsplus = array_values($this->petitsplus);
        }

        return $this;
    }

    /**
     * @param string $petitsPlus
     *
     * @return Job
     */
    public function switchPetitsPlus($petitsPlus)
    {
        if ($this->hasPetitsPlus($petitsPlus)) {
            $this->removePetitsPlus($petitsPlus);
        }
        else
        {
            $this->addPetitsPlus($petitsPlus);
        }

        return $this;
    }





























    // GENERATED CODE

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $latitude;

    /**
     * @var string
     */
    private $longitude;

    /**
     * @var string
     */
    private $rate_price;

    /**
     * @var string
     */
    private $rate_type;

    /**
     * @var string
     */
    private $duration;

    /**
     * @var string
     */
    private $how_to_apply;

    /**
     * @var string
     */
    private $calendar;

    /**
     * @var boolean
     */
    private $is_public;

    /**
     * @var boolean
     */
    private $is_activated;

    /**
     * @var \DateTime
     */
    private $expires_at;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \DateTime
     */
    private $updated_at;

    /**
     * @var string
     */
    private $category;

    /**
     * @var \Pn\PnBundle\Entity\Pparent
     */
    private $parent;


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
     * Set rate_price
     *
     * @param string $ratePrice
     * @return Job
     */
    public function setRatePrice($ratePrice)
    {
        $this->rate_price = $ratePrice;

        return $this;
    }

    /**
     * Get rate_price
     *
     * @return string 
     */
    public function getRatePrice()
    {
        return $this->rate_price;
    }

    /**
     * Set rate_type
     *
     * @param string $rateType
     * @return Job
     */
    public function setRateType($rateType)
    {
        $this->rate_type = $rateType;

        return $this;
    }

    /**
     * Get rate_type
     *
     * @return string 
     */
    public function getRateType()
    {
        return $this->rate_type;
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
     * Set how_to_apply
     *
     * @param string $howToApply
     * @return Job
     */
    public function setHowToApply($howToApply)
    {
        $this->how_to_apply = $howToApply;

        return $this;
    }

    /**
     * Get how_to_apply
     *
     * @return string 
     */
    public function getHowToApply()
    {
        return $this->how_to_apply;
    }

    /**
     * Set calendar
     *
     * @param string $calendar
     * @return Job
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
     * Set is_public
     *
     * @param boolean $isPublic
     * @return Job
     */
    public function setIsPublic($isPublic)
    {
        $this->is_public = $isPublic;

        return $this;
    }

    /**
     * Get is_public
     *
     * @return boolean 
     */
    public function getIsPublic()
    {
        return $this->is_public;
    }

    /**
     * Set is_activated
     *
     * @param boolean $isActivated
     * @return Job
     */
    public function setIsActivated($isActivated)
    {
        $this->is_activated = $isActivated;

        return $this;
    }

    /**
     * Get is_activated
     *
     * @return boolean 
     */
    public function getIsActivated()
    {
        return $this->is_activated;
    }

    /**
     * Set expires_at
     *
     * @param \DateTime $expiresAt
     * @return Job
     */
    public function setExpiresAt($expiresAt)
    {
        $this->expires_at = $expiresAt;

        return $this;
    }

    /**
     * Get expires_at
     *
     * @return \DateTime 
     */
    public function getExpiresAt()
    {
        return $this->expires_at;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Job
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
     * Set updated_at
     *
     * @param \DateTime $updatedAt
     * @return Job
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    /**
     * Get updated_at
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set category
     *
     * @param string $category
     * @return Job
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set experience
     *
     * @param integer $experience
     * @return Job
     */
    public function setExperience($experience)
    {
        $this->experience = $experience;

        return $this;
    }

    /**
     * Get experience
     *
     * @return integer 
     */
    public function getExperience()
    {
        return $this->experience;
    }

    /**
     * Set parent
     *
     * @param \Pn\PnBundle\Entity\Pparent $parent
     * @return Job
     */
    public function setParent(\Pn\PnBundle\Entity\Pparent $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Pn\PnBundle\Entity\Pparent 
     */
    public function getParent()
    {
        return $this->parent;
    }
    /**
     * @var \DateTime
     */
    private $start;

    /**
     * @var \DateTime
     */
    private $end;


    /**
     * Set start
     *
     * @param \DateTime $start
     * @return Job
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get start
     *
     * @return \DateTime 
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set end
     *
     * @param \DateTime $end
     * @return Job
     */
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * Get end
     *
     * @return \DateTime 
     */
    public function getEnd()
    {
        return $this->end;
    }
    /**
     * @var array
     */
    private $diplomas;


    /**
     * Set diplomas
     *
     * @param array $diplomas
     * @return Job
     */
    public function setDiplomas($diplomas)
    {
        $this->diplomas = $diplomas;

        return $this;
    }

    /**
     * Get diplomas
     *
     * @return array 
     */
    public function getDiplomas()
    {
        return $this->diplomas;
    }
    /**
     * @var array
     */
    private $ageofchildren;


    /**
     * Set ageofchildren
     *
     * @param array $ageofchildren
     * @return Job
     */
    public function setAgeofchildren($ageofchildren)
    {
        $this->ageofchildren = $ageofchildren;

        return $this;
    }

    /**
     * Get ageofchildren
     *
     * @return array 
     */
    public function getAgeofchildren()
    {
        return $this->ageofchildren;
    }
    /**
     * @var array
     */
    private $languages;


    /**
     * Set languages
     *
     * @param array $languages
     * @return Job
     */
    public function setLanguages($languages)
    {
        $this->languages = $languages;

        return $this;
    }

    /**
     * Get languages
     *
     * @return array 
     */
    public function getLanguages()
    {
        return $this->languages;
    }
    /**
     * @var array
     */
    private $petitsplus;

    /**
     * @var array
     */
    private $extraTasks;

    /**
     * @var array
     */
    private $particularite;


    /**
     * Set petitsplus
     *
     * @param array $petitsplus
     * @return Job
     */
    public function setPetitsplus($petitsplus)
    {
        $this->petitsplus = $petitsplus;

        return $this;
    }

    /**
     * Get petitsplus
     *
     * @return array 
     */
    public function getPetitsplus()
    {
        return $this->petitsplus;
    }

    /**
     * Set extraTasks
     *
     * @param array $extraTasks
     * @return Job
     */
    public function setExtraTasks($extraTasks)
    {
        $this->extraTasks = $extraTasks;

        return $this;
    }

    /**
     * Get extraTasks
     *
     * @return array 
     */
    public function getExtraTasks()
    {
        return $this->extraTasks;
    }

    /**
     * Set particularite
     *
     * @param array $particularite
     * @return Job
     */
    public function setParticularite($particularite)
    {
        $this->particularite = $particularite;

        return $this;
    }

    /**
     * Get particularite
     *
     * @return array 
     */
    public function getParticularite()
    {
        return $this->particularite;
    }
    /**
     * @var string
     */
    private $phone;


    /**
     * Set phone
     *
     * @param string $phone
     * @return Job
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }
}
