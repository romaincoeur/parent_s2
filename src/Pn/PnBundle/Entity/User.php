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
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
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
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }


    public function getRoles()
    {
        return array('ROLE_ADMIN');
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
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $email;


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
     * @var string
     */
    private $firstname;

    /**
     * @var string
     */
    private $lastname;

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
    /**
     * @var string
     */
    private $rawPassword;


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
     * @var \Pn\PnBundle\Entity\Babysitter
     */
    private $babysitter;


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
     * @var string
     */
    private $phone;


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

    public function getHiddenName()
    {
        return $this->getFirstname().' '.substr($this->getLastname(),0,1).'.';
    }

    /**
     * @var string
     */
    private $address;


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
     * @var string
     */
    private $latitude;

    /**
     * @var string
     */
    private $longitude;


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
     * @ORM\PrePersist
     */
    public function setDefaultValues()
    {
        $this->is_activated = true;
        $this->setUsername($this->email);
    }
    /**
     * @var \Pn\PnBundle\Entity\Pparent
     */
    private $parent;


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

    public function __toString()
    {
        return $this->getUsername();
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $sent_messages;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $received_messages;

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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $given_recommendations;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $received_recommendations;


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
     * @var boolean
     */
    private $confirmed;

    /**
     * @var string
     */
    private $confirmationToken;


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
     * @var \DateTime
     */
    private $birthdate;


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
}
