<?php

namespace Pn\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Babysitter
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Pn\CoreBundle\Entity\BabysitterRepository")
 */
class Babysitter
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
     * @ORM\Column(name="presentation", type="text")
     */
    private $presentation;

    /**
     * @var string
     *
     * @ORM\Column(name="hourlyratemin", type="string", length=255)
     */
    private $hourlyratemin;

    /**
     * @var string
     *
     * @ORM\Column(name="hourlyratemax", type="decimal")
     */
    private $hourlyratemax;

    /**
     * @var string
     *
     * @ORM\Column(name="experience", type="string", length=255)
     */
    private $experience;

    /**
     * @var integer
     *
     * @ORM\Column(name="trustpoints", type="integer")
     */
    private $trustpoints;

    /**
     * @var string
     *
     * @ORM\Column(name="anythingelse", type="text")
     */
    private $anythingelse;

    /**
     * @var string
     *
     * @ORM\Column(name="ageofchildren", type="string", length=255)
     */
    private $ageofchildren;

    /**
     * @var array
     *
     * @ORM\Column(name="availabilities", type="array")
     */
    private $availabilities;

    /**
     * @var string
     *
     * @ORM\Column(name="favoriteactivities", type="string", length=255)
     */
    private $favoriteactivities;

    /**
     * @var string
     *
     * @ORM\Column(name="hobbies", type="text")
     */
    private $hobbies;

    /**
     * @var string
     *
     * @ORM\Column(name="mychildren", type="string", length=255)
     */
    private $mychildren;

    /**
     * @ORM\OneToOne(targetEntity="Pn\UserBundle\Entity\User", cascade={"remove"})
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity="Pn\CoreBundle\Entity\Babysittercategory", cascade={"persist"})
     */
    private $categories;


















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
     * Set hourlyratemin
     *
     * @param string $hourlyratemin
     * @return Babysitter
     */
    public function setHourlyratemin($hourlyratemin)
    {
        $this->hourlyratemin = $hourlyratemin;

        return $this;
    }

    /**
     * Get hourlyratemin
     *
     * @return string
     */
    public function getHourlyratemin()
    {
        return $this->hourlyratemin;
    }

    /**
     * Set hourlyratemax
     *
     * @param string $hourlyratemax
     * @return Babysitter
     */
    public function setHourlyratemax($hourlyratemax)
    {
        $this->hourlyratemax = $hourlyratemax;

        return $this;
    }

    /**
     * Get hourlyratemax
     *
     * @return string
     */
    public function getHourlyratemax()
    {
        return $this->hourlyratemax;
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
     * Constructor
     */
    public function __construct()
    {
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set user
     *
     * @param \Pn\UserBundle\Entity\User $user
     * @return Babysitter
     */
    public function setUser(\Pn\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Pn\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add categories
     *
     * @param \Pn\CoreBundle\Entity\Babysittercategory $categories
     * @return Babysitter
     */
    public function addCategory(\Pn\CoreBundle\Entity\Babysittercategory $categories)
    {
        $this->categories[] = $categories;

        return $this;
    }

    /**
     * Remove categories
     *
     * @param \Pn\CoreBundle\Entity\Babysittercategory $categories
     */
    public function removeCategory(\Pn\CoreBundle\Entity\Babysittercategory $categories)
    {
        $this->categories->removeElement($categories);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCategories()
    {
        return $this->categories;
    }
}
