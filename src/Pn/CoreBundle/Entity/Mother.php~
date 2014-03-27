<?php

namespace Pn\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Parent
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Pn\CoreBundle\Entity\MotherRepository")
 */
class Mother
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
     * @ORM\OneToOne(targetEntity="Pn\UserBundle\Entity\User", cascade={"remove"})
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
     * Set user
     *
     * @param \Pn\UserBundle\Entity\User $user
     * @return Mother
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
}
