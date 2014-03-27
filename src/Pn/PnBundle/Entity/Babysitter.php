<?php

namespace Pn\PnBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Babysitter
 */
class Babysitter
{
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
    private $hourlyrate;

    /**
     * @var string
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
     * @var string
     */
    private $ageofchildren;

    /**
     * @var array
     */
    private $availabilities;

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
     * @var \Pn\PnBundle\Entity\Babysittercategory
     */
    private $babysittercategory;


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
     * Set hourlyrate
     *
     * @param string $hourlyrate
     * @return Babysitter
     */
    public function setHourlyrate($hourlyrate)
    {
        $this->hourlyrate = $hourlyrate;

        return $this;
    }

    /**
     * Get hourlyrate
     *
     * @return string 
     */
    public function getHourlyrate()
    {
        return $this->hourlyrate;
    }

    /**
     * Set experience
     *
     * @param string $experience
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
     * @return string 
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
     * @param string $ageofchildren
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
     * @return string 
     */
    public function getAgeofchildren()
    {
        return $this->ageofchildren;
    }

    /**
     * Set availabilities
     *
     * @param array $availabilities
     * @return Babysitter
     */
    public function setAvailabilities($availabilities)
    {
        $this->availabilities = $availabilities;

        return $this;
    }

    /**
     * Get availabilities
     *
     * @return array 
     */
    public function getAvailabilities()
    {
        return $this->availabilities;
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
     * Set babysittercategory
     *
     * @param \Pn\PnBundle\Entity\Babysittercategory $babysittercategory
     * @return Babysitter
     */
    public function setBabysittercategory(\Pn\PnBundle\Entity\Babysittercategory $babysittercategory = null)
    {
        $this->babysittercategory = $babysittercategory;

        return $this;
    }

    /**
     * Get babysittercategory
     *
     * @return \Pn\PnBundle\Entity\Babysittercategory 
     */
    public function getBabysittercategory()
    {
        return $this->babysittercategory;
    }
    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        // Add your code here
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue()
    {
        // Add your code here
    }
    /**
     * @var \Pn\PnBundle\Entity\User
     */
    private $user;


    /**
     * Set user
     *
     * @param \Pn\PnBundle\Entity\User $user
     * @return Babysitter
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
    private $avatar;

    /**
     * @var string
     */
    private $video;


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
     * Set avatar
     *
     * @param string $avatar
     * @return Babysitter
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return string 
     */
    public function getAvatar()
    {
        return $this->avatar;
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

}
