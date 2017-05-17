<?php

namespace EI\TouristicBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
//use Symfony\Component\Validator\Mapping\ClassMetadata;
//use Symfony\Component\Validator\Constraints\NotBlank;
use FOS\CommentBundle\Entity\Comment as BaseComment;
use FOS\CommentBundle\Model\SignedCommentInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Comment
 *
 * @ORM\Entity
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 */
class Comment extends BaseComment implements SignedCommentInterface
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


     /**
     * Thread of this comment
     *
     * @var Thread
     * @ORM\ManyToOne(targetEntity="EI\TouristicBundle\Entity\Thread")
     */
    protected $thread;
    
    /**
     * @ORM\ManyToOne(targetEntity="EI\AdminBundle\Entity\BR", inversedBy="comments")
     * @ORM\JoinColumn(name="br_id", referencedColumnName="id")
     */
    private $br;
    
    /**
     * Author of the comment
     *
     * @ORM\ManyToOne(targetEntity="EI\UserBundle\Entity\User")
     * @var User
     */
    protected $author;

    public function setAuthor(UserInterface $author)
    {
        $this->author = $author;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getAuthorName()
    {
        if (null === $this->getAuthor()) {
            return 'Anonymous';
        }

        return $this->getAuthor()->getUsername();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Set br
     *
     * @param \EI\AdminBundle\Entity\BR $br
     *
     * @return Comment
     */
    public function setBr(\EI\AdminBundle\Entity\BR $br = null)
    {
        $this->br = $br;

        return $this;
    }

    /**
     * Get br
     *
     * @return \EI\AdminBundle\Entity\BR
     */
    public function getBr()
    {
        return $this->br;
    }
}
