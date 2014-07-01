<?php


namespace Application\Sonata\UserBundle\Form\Handler;

use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Model\UserManagerInterface;
use FOS\UserBundle\Form\Handler\RegistrationFormHandler as BaseHandler;

/**
 *
 * This file is an adapted version of FOS User Bundle RegistrationFormHandler class
 *
 *    (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 */
class RegistrationFormHandler extends BaseHandler
{
    /**
     * @param boolean $confirmation
     */
    public function process($confirmation = false)
    {
        $user = $this->createUser();
        $this->form->setData($user);

        if ('POST' === $this->request->getMethod()) {
            $this->form->bind($this->request);

            if ($this->form->isValid()) {
                $user->setUsername($user->getEmail());

                $this->onSuccess($user, $confirmation);

                return true;
            }
        }

        return false;
    }
}
