<?php

namespace Pn\PnBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Util\SecureRandom;

/**
 * User
 */
class User implements UserInterface
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sent_messages = new \Doctrine\Common\Collections\ArrayCollection();
        $this->received_messages = new \Doctrine\Common\Collections\ArrayCollection();
        $this->confirmed = false;
        $generator = new SecureRandom();
        $this->confirmationToken = $generator->nextBytes(10);
    }


    /**
     * @ORM\PrePersist
     */
    public function setDefaultValues()
    {
        $this->is_activated = true;
        $this->setUsername($this->email);
        if ($this->getBirthdate() == null) $this->setBirthdate(new \DateTime('1990-01-01'));
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRoles()
    {
        if ($this->type == 'admin')
            return array('ROLE_SUPER_ADMIN');
        else
            return array('ROLE_USER');
    }

    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {

    }

    public function equals(UserInterface $user)
    {
        return $user->getUsername() == $this->getUsername();
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

    public static function getsecondTypes()
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

    public static function getsecondTypeValues()
    {
        return array_keys(self::getsecondTypes());
    }

    public function getHiddenName()
    {
        return $this->getFirstname().' '.substr($this->getLastname(),0,1).'.';
    }

    public function __toString()
    {
        return $this->getUsername();
    }

    /**
     * Get fullname
     *
     * @return string
     */
    public function getFullname()
    {
        return $this->firstname.' '.$this->lastname;
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

    public $file;

    protected function getUploadDir()
    {
        return 'uploads/users';
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

    public function age()
    {
        if ($this->birthdate == null)
            return null;
        $today = explode('.',date("d.m.Y"));
        if ($today[1] < $this->birthdate->format('m') || ($today[1] == $this->birthdate->format('m') && $today[0] < $this->birthdate->format('d')))
            return $today[2] - $this->birthdate->format('Y') - 1;
        else
            return $today[2] - $this->birthdate->format('Y');
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
            'garde' => 'Garde partagée',
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

































// GENERATED CODE

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $rawPassword;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $secondType;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $firstname;

    /**
     * @var string
     */
    private $lastname;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var boolean
     */
    private $is_activated;

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
    private $address;

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
     * @var boolean
     */
    private $confirmed;

    /**
     * @var string
     */
    private $confirmationToken;

    /**
     * @var \DateTime
     */
    private $birthdate;

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Set rawPassword
     *
     * @param string $rawPassword
     * @return User
     */
    public function setRawPassword($rawPassword)
    {
        $this->rawPassword = $rawPassword;

        return $this;
    }

    /**
     * Get rawPassword
     *
     * @return string
     */
    public function getRawPassword()
    {
        return $this->rawPassword;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return User
     */
    public function setType($type)
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
     * Set secondType
     *
     * @param string $secondType
     * @return User
     */
    public function setSecondType($secondType)
    {
        $this->secondType = $secondType;

        return $this;
    }

    /**
     * Get secondType
     *
     * @return string
     */
    public function getSecondType()
    {
        return $this->secondType;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return User
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

    /**
     * Set is_activated
     *
     * @param boolean $isActivated
     * @return User
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
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return User
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
     * @return User
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
     * Set confirmed
     *
     * @param boolean $confirmed
     * @return User
     */
    public function setConfirmed($confirmed)
    {
        $this->confirmed = $confirmed;

        return $this;
    }

    /**
     * Get confirmed
     *
     * @return boolean
     */
    public function getConfirmed()
    {
        return $this->confirmed;
    }

    /**
     * Set confirmationToken
     *
     * @param string $confirmationToken
     * @return User
     */
    public function setConfirmationToken($confirmationToken)
    {
        $this->confirmationToken = $confirmationToken;

        return $this;
    }

    /**
     * Get confirmationToken
     *
     * @return string
     */
    public function getConfirmationToken()
    {
        return $this->confirmationToken;
    }

    /**
     * Set birthdate
     *
     * @param \DateTime $birthdate
     * @return User
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * Get birthdate
     *
     * @return \DateTime
     */
    public function getBirthdate()
    {
        return $this->birthdate;
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
     * @var string
     */
    private $unacurateAddress;


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
}
