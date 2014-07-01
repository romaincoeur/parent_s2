<?php
/**
 * Created by PhpStorm.
 * User: romain
 * Date: 26/06/14
 * Time: 11:02
 */

namespace Application\Sonata\UserBundle\Form;


use Application\Sonata\UserBundle\Entity\User;
use Application\Sonata\UserBundle\Form\Model\UserRegistration;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class UserToRegisterTransformer implements DataTransformerInterface
{
    /**
     * @var ObjectManager
     */
    private $om;

    /**
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    /**
     * Transforms an object (User) to an object (UserRegistration).
     *
     * @param \Application\Sonata\UserBundle\Entity\User $user
     * @throws \Symfony\Component\Form\Exception\TransformationFailedException
     * @internal param \Application\Sonata\UserBundle\Entity\User|null $issue
     * @return UserRegistration
     */
    public function transform(User $user)
    {
        if (null === $user) {
            throw new TransformationFailedException('User cannot be found');
        }

        $userReg = new UserRegistration($user);

        return $userReg;
    }

    /**
     * Transforms an object (userReg) to an object (user).
     *
     * @param  UserRegistration $userReg
     * @return User|null
     * @throws TransformationFailedException if object (user) is not found.
     */
    public function reverseTransform($userReg)
    {
        if (!$userReg) {
            return null;
        }

        $user = $this->om
            ->getRepository('ApplicationSonataBundle:User')
            ->findOneByUsername($userReg->getUsername)
        ;

        if (null === $user) {
            throw new TransformationFailedException('User cannot be found');
        }

        return $user;
    }
} 