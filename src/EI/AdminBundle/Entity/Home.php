<?php

namespace EI\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Home
 *
 * @ORM\Table(name="home")
 * @ORM\Entity(repositoryClass="EI\AdminBundle\Repository\HomeRepository")
 */
class Home
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
     * @ORM\Column(name="mainTitle", type="string", length=255)
     */
    private $mainTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;
    
    /**
    * @var string
    *
    * @ORM\OneToMany(targetEntity="EI\AdminBundle\Entity\Event", mappedBy="home", cascade={"all"})
    */
    private $events;

    public function __construct()
    {
        $this->events = new ArrayCollection();
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
     * Set mainTitle
     *
     * @param string $mainTitle
     *
     * @return Home
     */
    public function setMainTitle($mainTitle)
    {
        $this->mainTitle = $mainTitle;

        return $this;
    }

    /**
     * Get mainTitle
     *
     * @return string
     */
    public function getMainTitle()
    {
        return $this->mainTitle;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Home
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
    
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * Add event
     *
     * @param \EI\AdminBundle\Entity\Event $event
     *
     * @return Home
     */
    public function addEvent(\EI\AdminBundle\Entity\Event $event)
    {
        $this->events[] = $event;
        $event->setHome($this);

        return $this;
    }

    /**
     * Remove event
     *
     * @param \EI\AdminBundle\Entity\Event $event
     */
    public function removeEvent(\EI\AdminBundle\Entity\Event $event)
    {
        $this->events->removeElement($event);
    }
}
