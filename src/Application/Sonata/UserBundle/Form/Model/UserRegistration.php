<?php



namespace Application\Sonata\UserBundle\Form\Model;

use Application\Sonata\UserBundle\Entity\User;
use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;
use Symfony\Component\Validator\Constraints as Assert;

class UserRegistration extends User
{
    public function __construct(User $user = null)
    {
        $this->email = $user->getEmail();
        $this->username = $user->getUsername();
        $this->firstname = $user->getFirstname();
        $this->lastname = $user->getLastname();
        $this->password = $user->getPassword();
    }

    /**
     * @var string
     */
    private $type;

    /**
     * Set menu
     *
     * @param string $type
     * @return userRegistration
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
}