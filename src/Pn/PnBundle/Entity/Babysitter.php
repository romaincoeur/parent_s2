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


    public $file;

    /**
     * @var \Pn\PnBundle\Entity\User
     */
    private $user;

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
     * @var string
     */
    private $calendar;

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
     * @var string
     */
    private $category;

    /**
     * @var string
     */
    private $petitsplus;

    /**
     * @var string
     */
    private $particularite;
























    public function __construct()
    {
        $this->diplomas = array();
        $this->ageofchildren = array();
        $this->languages = array();
        $this->particularite = array();
        $this->extraTasks = array();
        $this->petitsplus = array();
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

    public static function getPetitspluss()
    {
        return array(
            'repasmaison' => 'Repas cuisinés maison',
            'bio' => 'Repas bio',
            'promenade' => 'Promenade quotidienne',
            'notv' => 'Zéro télé'
        );
    }

    public static function getPetitsplusValues()
    {
        return array_keys(self::getRateType());
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
        return $this->getUser()->getFullname();
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

    public static function getExtraTaskss()
    {
        return array(
            'cleaning' => 'Ménage',
            'cooking' => 'Cuisine',
            'ironing' => 'Repassage',
            'homework' => 'Aide aux devoirs',
        );
    }

    public static function getExtraTasksValues()
    {
        return array_keys(self::getExtraTaskss());
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


    /**
     * @var array
     */
    private $extraTasks;

    /**
     * @var array
     */
    private $diplomas;

    /**
     * @var array
     */
    private $languages;


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
}
