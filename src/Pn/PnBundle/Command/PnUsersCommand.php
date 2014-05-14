<?php
/**
 * Created by PhpStorm.
 * User: romain
 * Date: 26/03/14
 * Time: 15:07
 */

// src/Pn/PnBundle/Command/PnUsersCommand.php

namespace Pn\PnBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Pn\PnBundle\Entity\User;

class PnUsersCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('pn:user:create')
            ->setDescription('Add admin user')
            ->addArgument('username', InputArgument::REQUIRED, 'The username')
            ->addArgument('password', InputArgument::REQUIRED, 'The password')
            ->addArgument('email', InputArgument::REQUIRED, 'Email')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $username = $input->getArgument('username');
        $password = $input->getArgument('password');
        $email = $input->getArgument('email');

        $em = $this->getContainer()->get('doctrine')->getManager();

        $user = new User();
        // encode the password
        $factory = $this->getContainer()->get('security.encoder_factory');
        $encoder = $factory->getEncoder($user);
        $encodedPassword = $encoder->encodePassword($password, $user->getSalt());
        $user->setPassword($encodedPassword);
        $em->persist($user);
        $user->setUsername($username);
        $user->setType('admin');
        $user->setEmail($email);
        $em->flush();

        $output->writeln(sprintf('Added %s user with password %s', $username, $password));
    }
}