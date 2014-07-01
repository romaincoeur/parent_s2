<?php


namespace Application\Sonata\NewsBundle\Entity;

use Sonata\NewsBundle\Entity\BaseComment as BaseComment;
use Doctrine\ORM\Mapping as ORM;


class Comment extends BaseComment
{
    /**
     * @var integer $id
     */
    protected $id;

    /**
     * @var \Application\Sonata\NewsBundle\Entity\Post
     */
    protected $post;















    /**
     * Set post
     *
     * @param \Application\Sonata\NewsBundle\Entity\Post $post
     * @return Comment
     */
    public function setPost($post)
    {
        $this->post = $post;

        return $this;
    }

























    // GENERATED CODE

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }





    /**
     * Get post
     *
     * @return \Application\Sonata\NewsBundle\Entity\Post 
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @ORM\PrePersist
     */
    public function setDefaultValues()
    {
        // Add your code here
    }
    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     */
    private $author;


    /**
     * Set author
     *
     * @param \Application\Sonata\UserBundle\Entity\User $author
     * @return Comment
     */
    public function setAuthor(\Application\Sonata\UserBundle\Entity\User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \Application\Sonata\UserBundle\Entity\User 
     */
    public function getAuthor()
    {
        return $this->author;
    }
}
