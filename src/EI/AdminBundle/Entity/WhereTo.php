<?php

namespace EI\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * WhereTo
 *
 * @ORM\Table(name="where_to")
 * @ORM\Entity(repositoryClass="EI\AdminBundle\Repository\WhereToRepository")
 */
class WhereTo
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
     *
     * @ORM\ManyToMany(targetEntity="EI\AdminBundle\Entity\BR", mappedBy="whereTos",cascade={"persist"})
     * @ORM\JoinColumn(referencedColumnName="id", nullable=true)    
     */
    private $brs;
    
    /**
    * @var string
    *
    * @ORM\ManyToMany(targetEntity="EI\AdminBundle\Entity\Category", inversedBy="wheretos")
    * @ORM\JoinColumn(referencedColumnName="id", nullable=true)   
    */
    private $categories;
    
   
    public function __toString(){
    return $this->title;
    }
    
    public function __construct()
    {
      $this->brs = new ArrayCollection();
      $this->categories = new ArrayCollection();
    }

    /**
     * Add br
     *
     * @param \EI\AdminBundle\Entity\BR $br
     *
     * @return WhereTo
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
     * @return WhereTo
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
     * Set whereToId
     *
     * @param integer $whereToId
     *
     * @return WhereTo
     */
    public function setWhereToId($whereToId)
    {
        $this->whereToId = $whereToId;

        return $this;
    }

    /**
     * Get whereToId
     *
     * @return integer
     */
    public function getWhereToId()
    {
        return $this->whereToId;
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
     * Add category
     *
     * @param \EI\AdminBundle\Entity\Category $category
     *
     * @return WhereTo
     */
    public function addCategory(\EI\AdminBundle\Entity\Category $category)
    {
        $this->categories[] = $category;
        $category->setWhereTo($this);

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
}
