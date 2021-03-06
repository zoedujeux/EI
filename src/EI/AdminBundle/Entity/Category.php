<?php

namespace EI\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="EI\AdminBundle\Repository\CategoryRepository")
 */
class Category
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
    * @ORM\OneToOne(targetEntity="EI\AdminBundle\Entity\Image", cascade={"persist", "remove"})
    * @ORM\JoinColumn(nullable=true) 
    */
    private $image;
    
     /**
    * @ORM\ManyToMany(targetEntity="EI\AdminBundle\Entity\BR", mappedBy="categories")
    * @ORM\JoinColumn(referencedColumnName="id", nullable=true)
    */
     private $brs;
     
    
    /**
    * @ORM\ManyToMany(targetEntity="EI\AdminBundle\Entity\WhereTo", mappedBy="categories")
    * @ORM\JoinColumn(referencedColumnName="id", nullable=true)   
    */
     private $wheretos;
    
    public function __toString(){
        return $this->title;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->brs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->wheretos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Category
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
     * @return Category
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
     * Set image
     *
     * @param \EI\AdminBundle\Entity\Image $image
     *
     * @return Category
     */
    public function setImage(\EI\AdminBundle\Entity\Image $image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \EI\AdminBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set br
     *
     * @param \EI\AdminBundle\Entity\BR $br
     *
     * @return Category
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


    /**
     * Add br
     *
     * @param \EI\AdminBundle\Entity\BR $br
     *
     * @return Category
     */
    public function addBr(\EI\AdminBundle\Entity\BR $br)
    {
        $this->brs[] = $br;

        return $this;
    }

    /**
     * Remove br
     *
     * @param \EI\AdminBundle\Entity\BR $br
     */
    public function removeBr(\EI\AdminBundle\Entity\BR $br)
    {
        $this->brs->removeElement($br);
    }

    /**
     * Get brs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBrs()
    {
        return $this->brs;
    }

    /**
     * Add whereto
     *
     * @param \EI\AdminBundle\Entity\WhereTo $whereto
     *
     * @return Category
     */
    public function addWhereto(\EI\AdminBundle\Entity\WhereTo $whereto)
    {
        $this->wheretos[] = $whereto;

        return $this;
    }

    /**
     * Remove whereto
     *
     * @param \EI\AdminBundle\Entity\WhereTo $whereto
     */
    public function removeWhereto(\EI\AdminBundle\Entity\WhereTo $whereto)
    {
        $this->wheretos->removeElement($whereto);
    }

    /**
     * Get wheretos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWheretos()
    {
        return $this->wheretos;
    }
}
