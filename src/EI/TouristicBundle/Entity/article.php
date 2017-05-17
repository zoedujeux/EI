<?php

namespace EI\TouristicBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="EI\TouristicBundle\Repository\articleRepository")
 */
class article
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
     * @ORM\Column(name="titleH1", type="string", length=255)
     */
    private $titleH1;

    /**
     * @var string
     *
     * @ORM\Column(name="titleH2", type="string", length=255)
     */
    private $titleH2;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;


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
     * Set titleH1
     *
     * @param string $titleH1
     *
     * @return article
     */
    public function setTitleH1($titleH1)
    {
        $this->titleH1 = $titleH1;

        return $this;
    }

    /**
     * Get titleH1
     *
     * @return string
     */
    public function getTitleH1()
    {
        return $this->titleH1;
    }

    /**
     * Set titleH2
     *
     * @param string $titleH2
     *
     * @return article
     */
    public function setTitleH2($titleH2)
    {
        $this->titleH2 = $titleH2;

        return $this;
    }

    /**
     * Get titleH2
     *
     * @return string
     */
    public function getTitleH2()
    {
        return $this->titleH2;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return article
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
}

