<?php

namespace Pn\PnBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Babysitter
 */
class Babysitter
{

    public function __construct()
    {
        $this->diplomas = array();
        $this->otherDiplomas = array();
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
        if ($this->getCategory() == null) $this->setCategory('nounou');
        if ($this->getExperience() == null) $this->setExperience(0);
        if ($this->getRatePrice() == null) $this->setRatePrice(0);
        if ($this->getRateType() == null) $this->setRateType('hour');
        if ($this->getTrustpoints() == null) $this->setTrustpoints(0);
        if ($this->calendar == null) $this->setCalendar('[(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)
        (0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)
        (0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)(0000000)
        (0000000)(0000000)]');
    }

    protected function getUploadDir()
    {
        return 'uploads/babysitters';
    }

    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../../web/uploads/babysitters'.$this->getUploadDir();
    }

    public function getWebPath()
    {
        return null === $this->video ? null : $this->getUploadDir().'/'.$this->video;
    }

    public function getAbsolutePath()
    {
        return null === $this->video ? null : $this->getUploadRootDir().'/'.$this->video;
    }

    /**
     * @var string
     */
    private $file;

    /**
     * @ORM\PrePersist
     */
    public function preUpload()
    {
        if (null !== $this->file) {
            // do whatever you want to generate a unique name
            $this->video = uniqid().'.'.$this->file->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist
     */
    public function upload()
    {
        if (null === $this->file) {
            return;
        }

        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->file->move($this->getUploadRootDir(), $this->video);

        unset($this->file);
    }

    /**
     * @ORM\PostRemove
     */
    public function removeUpload()
    {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
    }

    public function shortPresentation($maxLength)
    {
        if (strlen($this->presentation) <= $maxLength)
            return $this->presentation."...";

        $result = substr($this->presentation, 0, $maxLength);
        return $result."...";
    }

    public function __toString()
    {
        if ($this->getUser())
            return $this->getUser()->getFullname();
        else
            return '';
    }

    public static function getPetitsplusValues()
    {
        return array_keys(self::getPetitspluss());
    }

    /**
     * @param string $petitsPlus
     *
     * @return Babysitter
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
     * @return Babysitter
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
     * @return Babysitter
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

    /**
     * @param string $particularite
     *
     * @return Babysitter
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
     * @return Babysitter
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
     * @return Babysitter
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
     * @param string $diploma
     *
     * @return Babysitter
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
     * @return Babysitter
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
     * @return Babysitter
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
     * @param string $diploma
     *
     * @return Babysitter
     */
    public function addOtherDiploma($diploma)
    {
        if (!$this->hasOtherDiploma($diploma)) {
            $this->otherDiplomas[] = $diploma;
        }

        return $this;
    }

    /**
     * @param string $diploma
     */
    public function hasOtherDiploma($diploma)
    {
        return in_array($diploma, $this->otherDiplomas, true);
    }

    /**
     * @param string $diploma
     *
     * @return Babysitter
     */
    public function removeOtherDiploma($diploma)
    {
        if (false !== $key = array_search($diploma, $this->otherDiplomas, true)) {
            unset($this->otherDiplomas[$key]);
            $this->otherDiplomas = array_values($this->otherDiplomas);
        }

        return $this;
    }

    /**
     * @param string $diploma
     *
     * @return Babysitter
     */
    public function switchOtherDiploma($diploma)
    {
        if ($this->hasOtherDiploma($diploma)) {
            $this->removeOtherDiploma($diploma);
        }
        else
        {
            $this->addOtherDiploma($diploma);
        }

        return $this;
    }

    /**
     * @param string $language
     *
     * @return Babysitter
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
     * @return Babysitter
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
     * @return Babysitter
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
     * @param string $age
     *
     * @return Babysitter
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
     * @return Babysitter
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
     * @return Babysitter
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
     * @param string $extraTask
     *
     * @return Babysitter
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
     * @return Babysitter
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
     * @return Babysitter
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
     * Update and return trustpoints
     *
     * @return Integer
     */
    public function computeTrustpoints($values)
    {
        $result = 0;

        # Trustpoints Profile
        if ($this->user->getFirstname() != null) $result += $values['profile']['firstname'];
        if ($this->user->getLastname() != null) $result += $values['profile']['lastname'];
        if ($this->user->getDateOfBirth() != null) $result += $values['profile']['birthdate'];
        if ($this->user->getPostcode() != null) $result += $values['profile']['postcode'];
        if ($this->user->getCity() != null) $result += $values['profile']['city'];
        if ($this->user->getAddress() != null) $result += $values['profile']['address'];
        if ($this->user->getPhone() != null) $result += $values['profile']['phone'];
        if ($this->user->getAvatar() != null) $result += $values['profile']['avatar'];

        # trustpoints babysitter
        if ($this->getMychildren() != null) $result += $values['babysitter']['children'];
        if ($this->getFavoriteactivities() != null) $result += $values['babysitter']['favoriteActivity'];
        if ($this->getLanguages() != null) $result += $values['babysitter']['languages'];
        if ($this->getHobbies() != null) $result += $values['babysitter']['hobbies'];
        if ($this->getParticularite() != null) $result += $values['babysitter']['smoke'];
        if ($this->getPresentation() != null) $result += $values['babysitter']['presentation'];
        if ($this->getDiplomas() != null) $result += $values['babysitter']['diplomas'];
        if ($this->getCategory() != null) $result += $values['babysitter']['category'];
        if ($this->getAgeofchildren() != null) $result += $values['babysitter']['ageOfChildren'];
        if ($this->getCalendar() != null) $result += $values['babysitter']['calendar'];
        if ($this->getRatePrice() != null) $result += $values['babysitter']['priceRate'];

        $this->setTrustpoints($result);
        return $result;
    }

    /**
     * returns a formated url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->user->getFirstname().'-'
        .substr($this->user->getLastname(),0,1).'-'
        .strtolower(str_replace(' ','-',$this->user->getCategories()[$this->getCategory()])).'-'
        .$this->user->getPostcode();
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



























// GENERATED CODE

    

    
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $presentation;

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
    private $video;

    /**
     * @var integer
     */
    private $experience;

    /**
     * @var integer
     */
    private $trustpoints;

    /**
     * @var string
     */
    private $anythingelse;

    /**
     * @var array
     */
    private $ageofchildren;

    /**
     * @var string
     */
    private $favoriteactivities;

    /**
     * @var string
     */
    private $hobbies;

    /**
     * @var string
     */
    private $mychildren;

    /**
     * @var string
     */
    private $calendar;

    /**
     * @var string
     */
    private $category;

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
     * @var array
     */
    private $diplomas;

    /**
     * @var array
     */
    private $otherDiplomas;

    /**
     * @var array
     */
    private $languages;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \DateTime
     */
    private $updated_at;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
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
     * Set presentation
     *
     * @param string $presentation
     * @return Babysitter
     */
    public function setPresentation($presentation)
    {
        $this->presentation = $presentation;

        return $this;
    }

    /**
     * Get presentation
     *
     * @return string 
     */
    public function getPresentation()
    {
        return $this->presentation;
    }

    /**
     * Set rate_price
     *
     * @param string $ratePrice
     * @return Babysitter
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
     * @return Babysitter
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
     * Set video
     *
     * @param string $video
     * @return Babysitter
     */
    public function setVideo($video)
    {
        $this->video = $video;

        return $this;
    }

    /**
     * Get video
     *
     * @return string 
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * Set experience
     *
     * @param integer $experience
     * @return Babysitter
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
     * Set trustpoints
     *
     * @param integer $trustpoints
     * @return Babysitter
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
     * Set anythingelse
     *
     * @param string $anythingelse
     * @return Babysitter
     */
    public function setAnythingelse($anythingelse)
    {
        $this->anythingelse = $anythingelse;

        return $this;
    }

    /**
     * Get anythingelse
     *
     * @return string 
     */
    public function getAnythingelse()
    {
        return $this->anythingelse;
    }

    /**
     * Set ageofchildren
     *
     * @param array $ageofchildren
     * @return Babysitter
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
     * Set favoriteactivities
     *
     * @param string $favoriteactivities
     * @return Babysitter
     */
    public function setFavoriteactivities($favoriteactivities)
    {
        $this->favoriteactivities = $favoriteactivities;

        return $this;
    }

    /**
     * Get favoriteactivities
     *
     * @return string 
     */
    public function getFavoriteactivities()
    {
        return $this->favoriteactivities;
    }

    /**
     * Set hobbies
     *
     * @param string $hobbies
     * @return Babysitter
     */
    public function setHobbies($hobbies)
    {
        $this->hobbies = $hobbies;

        return $this;
    }

    /**
     * Get hobbies
     *
     * @return string 
     */
    public function getHobbies()
    {
        return $this->hobbies;
    }

    /**
     * Set mychildren
     *
     * @param string $mychildren
     * @return Babysitter
     */
    public function setMychildren($mychildren)
    {
        $this->mychildren = $mychildren;

        return $this;
    }

    /**
     * Get mychildren
     *
     * @return string 
     */
    public function getMychildren()
    {
        return $this->mychildren;
    }

    /**
     * Set calendar
     *
     * @param string $calendar
     * @return Babysitter
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
     * Set category
     *
     * @param string $category
     * @return Babysitter
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
     * Set petitsplus
     *
     * @param array $petitsplus
     * @return Babysitter
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
     * @return Babysitter
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
     * @return Babysitter
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
     * Set diplomas
     *
     * @param array $diplomas
     * @return Babysitter
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
     * Set otherDiplomas
     *
     * @param array $otherDiplomas
     * @return Babysitter
     */
    public function setOtherDiplomas($otherDiplomas)
    {
        $this->otherDiplomas = $otherDiplomas;

        return $this;
    }

    /**
     * Get otherDiplomas
     *
     * @return array 
     */
    public function getOtherDiplomas()
    {
        return $this->otherDiplomas;
    }

    /**
     * Set languages
     *
     * @param array $languages
     * @return Babysitter
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
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Babysitter
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
     * @return Babysitter
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
     * Set user
     *
     * @param \Application\Sonata\UserBundle\Entity\User $user
     * @return Babysitter
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
}
