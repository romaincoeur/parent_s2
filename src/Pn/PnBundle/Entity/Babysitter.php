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

    public $file;


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

    public function getUserUsername()
    {
        return $this->user->getUsername();
    }

    protected function getUploadDir()
    {
        return 'uploads/babysitters';
    }

    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    public function getWebPath()
    {
        return null === $this->avatar ? null : $this->getUploadDir().'/'.$this->avatar;
    }

    public function getAbsolutePath()
    {
        return null === $this->avatar ? null : $this->getUploadRootDir().'/'.$this->avatar;
    }


    /**
     * @ORM\PrePersist
     */
    public function preUpload()
    {
        if (null !== $this->file) {
            // do whatever you want to generate a unique name
            $this->avatar = uniqid().'.'.$this->file->guessExtension();
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
        $this->file->move($this->getUploadRootDir(), $this->avatar);

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
    /**
     * @var string
     */
    private $calendar;


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
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \DateTime
     */
    private $updated_at;

    /**
     * @var boolean
     */
    private $new;


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
     * Set new
     *
     * @param boolean $new
     * @return Babysitter
     */
    public function setNew($new)
    {
        $this->new = $new;

        return $this;
    }

    /**
     * Get new
     *
     * @return boolean
     */
    public function getNew()
    {
        return $this->new;
    }
    /**
     * @var string
     */
    private $category;


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
        if ($this->category != null)
            return $this->getCategories()[$this->category];
        else
            return "";
    }

    public static function getCategories()
    {
        return array(
            'babysitter' => 'Babysitter',
            'assistante' => 'Assistante maternelle',
            'nounou' => 'Nounou à domicile',
            'garde' => 'Garde partagée',
            'aupair' => 'Fille au pair',
            'animateur' => 'Animateur'
        );
    }

    public static function getCategoryValues()
    {
        return array_keys(self::getRateType());
    }

    /**
     * @ORM\PrePersist
     */
    public function setDefaultValues()
    {
        if ($this->getPresentation() == null) $this->setPresentation('Décrivez-vous en quelques lignes');
        if ($this->getCategory() == null) $this->setCategory('nounou');
        if ($this->getExperience() == null) $this->setExperience(0);
        if ($this->getNew() == null) $this->setNew(true);
        if ($this->getRatePrice() == null) $this->setRatePrice(0);
        if ($this->getRateType() == null) $this->setRateType('hour');
        if ($this->getTrustpoints() == null) $this->setTrustpoints(0);
    }
    /**
     * @var string
     */
    private $petitsplus;


    /**
     * Set petitsplus
     *
     * @param string $petitsplus
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
     * @return string
     */
    public function getPetitsplus()
    {
        return $this->petitsplus;
    }

    public static function getPetitspluss()
    {
        return array('repasmaison' => 'Repas cuisinés maison', 'bio' => 'Repas bio', 'promenade' => 'Promenade quotidienne', 'notv' => 'Zéro télé');
    }

    public static function getPetitsplusValues()
    {
        return array_keys(self::getRateType());
    }

    /**
     * @var string
     */
    private $particularite;


    /**
     * Set particularite
     *
     * @param string $particularite
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
     * @return string
     */
    public function getParticularite()
    {
        return $this->particularite;
    }

    public static function getParticularites()
    {
        return array(
            'nonfumeur' => 'Non fumeur',
            'animaux' => 'Pas d\'animaux domestiques',
            'permis' => 'Avec permis de conduire',
            'voiture' => 'Avec voiture',
            'lettre' => 'Lettres de recommandation');
    }

    public static function getParticulariteValues()
    {
        return array_keys(self::getRateType());
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
        return $this->getUser()->getFirstname();
    }
    /**
     * @var array
     */
    private $diplomas;

    /**
     * @var array
     */
    private $languages;


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

    public static function getDiplomass()
    {
        return array(
            'assistante' => 'Agrément assistante maternelle',
            'bafa' => 'Brevet d\'aptitude aux fonctions d\'animateur (BAFA)',
        );
    }

    public static function getDiplomasValues()
    {
        return array_keys(self::getRateType());
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

    public static function getLanguagess()
    {
        return array(
            'fr' => 'Francais',
            'en' => 'Anglais',
            'ge' => 'Allemand',
            'it' => 'Italien',
            'es' => 'Espagnol',
            'ru' => 'Russe',
            'po' => 'Portugais',
            'ar' => 'Arabe',
        );
    }

    public static function getLanguagesValues()
    {
        return array_keys(self::getRateType());
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

    public static function getAgeofchildrens()
    {
        return array(
            0 => '0 à 1 an',
            1 => '1 à 3 ans',
            2 => '3 à 6 an',
            3 => '6 à 10 ans',
            4 => '10 ans et +',
        );
    }

    public static function getAgeofchildrenValues()
    {
        return array_keys(self::getRateType());
    }
}
