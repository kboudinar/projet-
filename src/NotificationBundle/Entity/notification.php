<?php

namespace NotificationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * notification
 *
 * @ORM\Table(name="notification")
 * @ORM\Entity(repositoryClass="NotificationBundle\Repository\notificationRepository")
 */
class notification
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
     * @var int
     *
     *
     * @ORM\Column(name="readn", type="integer")
     */
    private $readn;

    /**
     * @return string
     */
    
    public function getReadn()
    {
        return $this->readn;
    }

    /**
     * @param string $readn
     */
    public function setReadn($readn)
    {
        $this->readn = $readn;
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
     * @return notification
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
     * @var \Candidat
     *
     * @ORM\ManyToOne(targetEntity="Candidat")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idcandidat", referencedColumnName="idcandidat")
     * })
     */
    private $idcandidat;

    /**
     * @return \Candidat
     */
    public function getIdcandidat()
    {
        return $this->idcandidat;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param \Candidat $idcandidat
     */
    public function setIdcandidat($idcandidat)
    {
        $this->idcandidat = $idcandidat;
    }
}

