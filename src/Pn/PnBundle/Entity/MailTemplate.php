<?php

namespace Pn\PnBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MailTemplate
 */
class MailTemplate
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $object;

    /**
     * @var string
     */
    private $body;


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
     * Set title
     *
     * @param string $title
     * @return MailTemplate
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set object
     *
     * @param string $object
     * @return MailTemplate
     */
    public function setObject($object)
    {
        $this->object = $object;

        return $this;
    }

    /**
     * Get object
     *
     * @return string 
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * Set body
     *
     * @param string $body
     * @return MailTemplate
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string 
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @var string
     */
    private $virtuaTtitle;


    /**
     * Set virtuaTtitle
     *
     * @param string $virtuaTtitle
     * @return MailTemplate
     */
    public function setVirtuaTtitle($virtuaTtitle)
    {
        $this->virtuaTtitle = $virtuaTtitle;

        return $this;
    }

    /**
     * Get virtuaTtitle
     *
     * @return string 
     */
    public function getVirtuaTtitle()
    {
        return $this->virtuaTtitle;
    }
    /**
     * @var string
     */
    private $virtualTitle;


    /**
     * Set virtualTitle
     *
     * @param string $virtualTitle
     * @return MailTemplate
     */
    public function setVirtualTitle($virtualTitle)
    {
        $this->virtualTitle = $virtualTitle;

        return $this;
    }

    /**
     * Get virtualTitle
     *
     * @return string 
     */
    public function getVirtualTitle()
    {
        return $this->virtualTitle;
    }
}
