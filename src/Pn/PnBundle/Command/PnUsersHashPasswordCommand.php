<?php
/**
 * Created by PhpStorm.
 * User: romain
 * Date: 26/03/14
 * Time: 15:07
 */

// src/Pn/PnBundle/Command/PnUsersHashPasswordCommand.php

namespace Pn\PnBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PnUsersHashPasswordCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('pn:user:hash')
            ->setDescription('Get hash password')
            ->addArgument('username', InputArgument::REQUIRED, 'The username')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $username = $input->getArgument('username');

        $em = $this->getContainer()->get('doctrine')->getManager();
        $user = $em->getRepository('PnPnBundle:User')->findOneByUsername($username);;

        // encode the password
        $factory = $this->getContainer()->get('security.encoder_factory');
        $encoder = $factory->getEncoder($user);
        $encodedPassword = $encoder->encodePassword($user->getRawPassword(), $user->getSalt());
        $user->setPassword($encodedPassword);
        $em->persist($user);
        $em->flush();

        $output->writeln(sprintf('done'));
    }
}