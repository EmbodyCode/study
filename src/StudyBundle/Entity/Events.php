<?php

namespace StudyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Security\Core\Util\SecureRandom;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Events
 * 
 * @ORM\Table(name="events")
 * @ORM\Entity(repositoryClass="StudyBundle\Repository\EventsRepository")
 * @Vich\Uploadable
 */
class Events {

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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime")
     */
    private $updatedAt;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="event_avatar", fileNameProperty="avatarFileName")
     * 
     * @var File
     */
    private $avatarFile;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $avatarFileName;

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile
     *
     * @return Events
     */
    public function setAvatarFile(File $avatarFile = null) {
        $this->avatarFile = $avatarFile;

        return $this;
    }

    /**
     * @return File|null
     */
    public function getAvatarFile() {
        return $this->avatarFile;
    }

    /**
     * @param string $avatarFileName
     *
     * @return Events
     */
    public function setAvatarFileName($avatarFileName) {
        $this->avatarFileName = $avatarFileName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAvatarFileName() {
        return $this->avatarFileName;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Events
     */
    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Events
     */
    public function setDate($date) {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate() {
        return $this->date;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Events
     */
    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt() {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param string $updatedAt
     * @return Events
     */
    public function setUpdatedAt($updatedAt) {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return string 
     */
    public function getUpdatedAt() {
        return $this->updatedAt;
    }

}
