<?php

namespace EI\TouristicBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MailChimp
 *
 * @ORM\Table(name="mail_chimp")
 * @ORM\Entity(repositoryClass="EI\TouristicBundle\Repository\MailChimpRepository")
 */
class MailChimp
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
     * @ORM\Column(name="mail", type="string", length=255)
     */
    private $mail;


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
     * Set mail
     *
     * @param string $mail
     *
     * @return MailChimp
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }
}

