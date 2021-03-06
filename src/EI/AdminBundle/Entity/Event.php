<?php

namespace EI\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Event
 *
 * @ORM\Table(name="event")
 * @ORM\Entity(repositoryClass="EI\AdminBundle\Repository\EventRepository")
 */
class Event
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
    * @ORM\ManyToOne(targetEntity="EI\AdminBundle\Entity\Home", inversedBy="events")
    * @ORM\JoinColumn(referencedColumnName="id", nullable=true)
    */
     private $home;
     
    /**
    * @var string
    *
    * @ORM\OneToMany(targetEntity="EI\AdminBundle\Entity\Image", mappedBy="event", cascade={"all"})
    */
    private $images;
    
    public function __toString(){
    return $this->title;
    }
    
    public function __construct()
    {
      $this->images = new ArrayCollection();
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
     * @return Event
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
     * Set content
     *
     * @param string $content
     *
     * @return Event
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
     * Set home
     *
     * @param \EI\AdminBundle\Entity\Home $home
     *
     * @return Event
     */
    public function setHome(\EI\AdminBundle\Entity\Home $home)
    {
        $this->home = $home;

        return $this;
    }

    /**
     * Get home
     *
     * @return \EI\AdminBundle\Entity\Home
     */
    public function getHome()
    {
        return $this->home;
    }

    

    /**
     * Add image
     *
     * @param \EI\AdminBundle\Entity\Image $image
     *
     * @return Event
     */
    public function addImage(\EI\AdminBundle\Entity\Image $image)
    {
        $this->images[] = $image;
        $image->setEvent($this);

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
}
