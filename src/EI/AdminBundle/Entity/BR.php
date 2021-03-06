<?php

namespace EI\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * BR
 *
 * @ORM\Table(name="b_r")
 * @ORM\Entity(repositoryClass="EI\AdminBundle\Repository\BRRepository")
 */
class BR
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;
    
     /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;   
    
    /**
    * @var string
    *
    * @ORM\OneToMany(targetEntity="EI\AdminBundle\Entity\Image", mappedBy="br", cascade={"all"})
    */
    private $images;
    
    /**
    * @var string
    *
    * @ORM\ManyToMany(targetEntity="EI\AdminBundle\Entity\Category", inversedBy="brs", cascade={"all"})
    */
    private $categories;    
    
    /**
     * @var string
     * @ORM\ManyToMany(targetEntity="EI\AdminBundle\Entity\WhereTo", inversedBy="brs", cascade={"all"})
     * 
     */
    private $whereTos;
    
    /**
     * @ORM\OneToMany(targetEntity="EI\TouristicBundle\Entity\Comment", mappedBy="br")
     */
    protected $comments;
    
//    /**
//    * @ORM\OneToOne(targetEntity="EI\TouristicBundle\Entity\Thread", cascade={"persist"})
//    */
//    private $thread;
    
    public function __toString(){
        return $this->title;
    }

    public function __construct()
    {
      $this->whereTos = new ArrayCollection();
      $this->images = new ArrayCollection();
      $this->categories = new ArrayCollection();
      $this->comments = new ArrayCollection();
//      $this->setCreated(new \DateTime());
//      $this->setUpdated(new \DateTime());
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
     * Set title
     *
     * @param string $title
     *
     * @return BR
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
     * Constructor
     */

    /**
     * Set content
     *
     * @param string $content
     *
     * @return BR
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Add whereTo
     *
     * @param \EI\AdminBundle\Entity\WhereTo $whereTo
     *
     * @return BR
     */
    public function addWhereTo(\EI\AdminBundle\Entity\WhereTo $whereTo)
    {
        $this->whereTos[] = $whereTo;
        $whereTo->setBr($this);

        return $this;
    }

    /**
     * Remove whereTo
     *
     * @param \EI\AdminBundle\Entity\WhereTo $whereTo
     */
    public function removeWhereTo(\EI\AdminBundle\Entity\WhereTo $whereTo)
    {
        $this->whereTos->removeElement($whereTo);
    }

    /**
     * Get whereTos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWhereTos()
    {
        return $this->whereTos;
    }


    /**
     * Add image
     *
     * @param \EI\AdminBundle\Entity\Image $image
     *
     * @return BR
     */
    public function addImage(\EI\AdminBundle\Entity\Image $image)
    {
        $this->images[] = $image;
        $image->setBr($this);

        return $this;
    }

    /**
     * Remove image
     *
     * @param \EI\AdminBundle\Entity\Image $image
     */
    public function removeImage(\EI\AdminBundle\Entity\Image $image)
    {
        $this->images->removeElement($image);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Add category
     *
     * @param \EI\AdminBundle\Entity\Category $category
     *
     * @return BR
     */
    public function addCategory(\EI\AdminBundle\Entity\Category $category)
    {
        $this->categories[] = $category;
        $category->setBr($this);

        return $this;
    }

    /**
     * Remove category
     *
     * @param \EI\AdminBundle\Entity\Category $category
     */
    public function removeCategory(\EI\AdminBundle\Entity\Category $category)
    {
        $this->categories->removeElement($category);
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

    /**
     * Add comment
     *
     * @param \EI\TouristicBundle\Entity\Comment $comment
     *
     * @return BR
     */
    public function addComment(\EI\TouristicBundle\Entity\Comment $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \EI\TouristicBundle\Entity\Comment $comment
     */
    public function removeComment(\EI\TouristicBundle\Entity\Comment $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }

//    /**
//     * Set thread
//     *
//     * @param \EI\TouristicBundle\Entity\Thread $thread
//     *
//     * @return BR
//     */
//    public function setThread(\EI\TouristicBundle\Entity\Thread $thread = null)
//    {
//        $this->thread = $thread;
//
//        return $this;
//    }
//
//    /**
//     * Get thread
//     *
//     * @return \EI\TouristicBundle\Entity\Thread
//     */
//    public function getThread()
//    {
//        return $this->thread;
//    }
}
