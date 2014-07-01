<?php

namespace Application\Sonata\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sonata\UserBundle\Entity\BaseUser as BaseUser;

/**
 * User
 */
class User extends BaseUser
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $groups;






    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->groups = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @ORM\PrePersist
     */
    public function setDefaultValues()
    {
        if (!$this->username) $this->setUsername($this->email);
        if ($this->getDateOfBirth() == null) $this->setDateOfBirth(new \DateTime('1990-01-01'));
    }





    /**
     * Add groups
     *
     * @param \Application\Sonata\UserBundle\Entity\Group $groups
     * @return User
     */
    public function addGroup(\FOS\UserBundle\Model\GroupInterface $groups)
    {
        $this->groups[] = $groups;

        return $this;
    }

    /**
     * Remove groups
     *
     * @param \Application\Sonata\UserBundle\Entity\Group $groups
     */
    public function removeGroup(\FOS\UserBundle\Model\GroupInterface $groups)
    {
        $this->groups->removeElement($groups);
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
        return array_keys(self::getDiplomass());
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
        return array_keys(self::getParticularites());
    }

    public static function getCategories()
    {
        return array(
            'babysitter' => 'Babysitter',
            'assistante' => 'Assistante maternelle',
            'nounou' => 'Nounou à domicile',
            //'garde' => 'Garde partagée',
            'aupair' => 'Fille au pair',
            'animateur' => 'Animateur'
        );
    }

    public static function getCategoryValues()
    {
        return array_keys(self::getCategories());
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
        return array_keys(self::getLanguagess());
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
        return array_keys(self::getAgeofchildrens());
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

    public static function getRateTypes()
    {
        return array('hour' => 'Heure', 'month' => 'Mois', 'forfait' => 'Forfait');
    }

    public static function getRateTypeValues()
    {
        return array_keys(self::getRateTypes());
    }

    /**
     * @var string
     */
    private $secondType;

    /**
     * @param string $secondType
     */
    public function setSecondType($secondType)
    {
        $this->secondType = $secondType;
    }

    /**
     * @return string
     */
    public function getSecondType()
    {
        return $this->secondType;
    }

    public static function getsecondTypes()
    {
        return array(
            'babysitter' => 'Babysitter',
            'assistante' => 'Assistante maternelle',
            'nounou' => 'Nounou à domicile',
            //'garde' => 'Garde partagée',
            'aupair' => 'Fille au pair',
            'animateur' => 'Animateur'
        );
    }

    public static function getsecondTypeValues()
    {
        return array_keys(self::getsecondTypes());
    }

    public function getHiddenName()
    {
        return $this->getFirstname().' '.substr($this->getLastname(),0,1).'.';
    }

    public $file;

    protected function getUploadDir()
    {
        return 'uploads/users';
    }

    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../../../web/'.$this->getUploadDir();
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

    public function age()
    {
        if ($this->getDateOfBirth() == null)
            return null;
        $today = explode('.',date("d.m.Y"));
        if ($today[1] < $this->getDateOfBirth()->format('m') || ($today[1] == $this->getDateOfBirth()->format('m') && $today[0] < $this->getDateOfBirth()->format('d')))
            return $today[2] - $this->getDateOfBirth()->format('Y') - 1;
        else
            return $today[2] - $this->getDateOfBirth()->format('Y');
    }

    /**
     * @var string
     */
    private $type;

    /**
     * Set menu
     *
     * @param string $type
     * @return User
     */
    public function setType($type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get virtual name
     *
     * @return string
     */
    public function getVirtualname()
    {
        return mb_strtolower($this->firstname.$this->lastname);
    }




























    // GENERATED CODE

   
    
    /**
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $unacurateAddress;

    /**
     * @var string
     */
    private $postcode;

    /**
     * @var string
     */
    private $departement;

    /**
     * @var string
     */
    private $city;

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
    private $avatar;

    /**
     * @var \Pn\PnBundle\Entity\Babysitter
     */
    private $babysitter;

    /**
     * @var \Pn\PnBundle\Entity\Pparent
     */
    private $parent;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $sent_messages;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $received_messages;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $given_recommendations;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $received_recommendations;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $comments;


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
     * Set address
     *
     * @param string $address
     * @return User
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
     * Set unacurateAddress
     *
     * @param string $unacurateAddress
     * @return User
     */
    public function setUnacurateAddress($unacurateAddress)
    {
        $this->unacurateAddress = $unacurateAddress;

        return $this;
    }

    /**
     * Get unacurateAddress
     *
     * @return string 
     */
    public function getUnacurateAddress()
    {
        return $this->unacurateAddress;
    }

    /**
     * Set postcode
     *
     * @param string $postcode
     * @return User
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;

        return $this;
    }

    /**
     * Get postcode
     *
     * @return string 
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * Set departement
     *
     * @param string $departement
     * @return User
     */
    public function setDepartement($departement)
    {
        $this->departement = $departement;

        return $this;
    }

    /**
     * Get departement
     *
     * @return string 
     */
    public function getDepartement()
    {
        return $this->departement;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return User
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     * @return User
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
     * @return User
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
     * Set avatar
     *
     * @param string $avatar
     * @return User
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
     * Set babysitter
     *
     * @param \Pn\PnBundle\Entity\Babysitter $babysitter
     * @return User
     */
    public function setBabysitter(\Pn\PnBundle\Entity\Babysitter $babysitter = null)
    {
        $this->babysitter = $babysitter;

        return $this;
    }

    /**
     * Get babysitter
     *
     * @return \Pn\PnBundle\Entity\Babysitter 
     */
    public function getBabysitter()
    {
        return $this->babysitter;
    }

    /**
     * Set parent
     *
     * @param \Pn\PnBundle\Entity\Pparent $parent
     * @return User
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
     * Add sent_messages
     *
     * @param \Pn\PnBundle\Entity\Message $sentMessages
     * @return User
     */
    public function addSentMessage(\Pn\PnBundle\Entity\Message $sentMessages)
    {
        $this->sent_messages[] = $sentMessages;

        return $this;
    }

    /**
     * Remove sent_messages
     *
     * @param \Pn\PnBundle\Entity\Message $sentMessages
     */
    public function removeSentMessage(\Pn\PnBundle\Entity\Message $sentMessages)
    {
        $this->sent_messages->removeElement($sentMessages);
    }

    /**
     * Get sent_messages
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSentMessages()
    {
        return $this->sent_messages;
    }

    /**
     * Add received_messages
     *
     * @param \Pn\PnBundle\Entity\Message $receivedMessages
     * @return User
     */
    public function addReceivedMessage(\Pn\PnBundle\Entity\Message $receivedMessages)
    {
        $this->received_messages[] = $receivedMessages;

        return $this;
    }

    /**
     * Remove received_messages
     *
     * @param \Pn\PnBundle\Entity\Message $receivedMessages
     */
    public function removeReceivedMessage(\Pn\PnBundle\Entity\Message $receivedMessages)
    {
        $this->received_messages->removeElement($receivedMessages);
    }

    /**
     * Get received_messages
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getReceivedMessages()
    {
        return $this->received_messages;
    }

    /**
     * Add given_recommendations
     *
     * @param \Pn\PnBundle\Entity\Recommendation $givenRecommendations
     * @return User
     */
    public function addGivenRecommendation(\Pn\PnBundle\Entity\Recommendation $givenRecommendations)
    {
        $this->given_recommendations[] = $givenRecommendations;

        return $this;
    }

    /**
     * Remove given_recommendations
     *
     * @param \Pn\PnBundle\Entity\Recommendation $givenRecommendations
     */
    public function removeGivenRecommendation(\Pn\PnBundle\Entity\Recommendation $givenRecommendations)
    {
        $this->given_recommendations->removeElement($givenRecommendations);
    }

    /**
     * Get given_recommendations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGivenRecommendations()
    {
        return $this->given_recommendations;
    }

    /**
     * Add received_recommendations
     *
     * @param \Pn\PnBundle\Entity\Recommendation $receivedRecommendations
     * @return User
     */
    public function addReceivedRecommendation(\Pn\PnBundle\Entity\Recommendation $receivedRecommendations)
    {
        $this->received_recommendations[] = $receivedRecommendations;

        return $this;
    }

    /**
     * Remove received_recommendations
     *
     * @param \Pn\PnBundle\Entity\Recommendation $receivedRecommendations
     */
    public function removeReceivedRecommendation(\Pn\PnBundle\Entity\Recommendation $receivedRecommendations)
    {
        $this->received_recommendations->removeElement($receivedRecommendations);
    }

    /**
     * Get received_recommendations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getReceivedRecommendations()
    {
        return $this->received_recommendations;
    }

    /**
     * Add comments
     *
     * @param \Application\Sonata\NewsBundle\Entity\Comment $comments
     * @return User
     */
    public function addComment(\Application\Sonata\NewsBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \Application\Sonata\NewsBundle\Entity\Comment $comments
     */
    public function removeComment(\Application\Sonata\NewsBundle\Entity\Comment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Get groups
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGroups()
    {
        return $this->groups;
    }
}
