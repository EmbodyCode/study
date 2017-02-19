<?php

namespace StudyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * News
 *
 * @ORM\Table(name="news")
 * @ORM\Entity(repositoryClass="StudyBundle\Repository\NewsRepository")
 */
class News
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
     * @ORM\Column(name="title", type="string", length=500)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="shortText", type="string", length=800)
     */
    private $shortText;

    /**
     * @var string
     *
     * @ORM\Column(name="fullNewsText", type="string", length=6000)
     */
    private $fullNewsText;

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
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=500)
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;
    
    /**
     * @var integer
     * @ORM\Column(name="classDestination", type="integer", length=255)
     */
    private $classDestination;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return News
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
     * Set shortText
     *
     * @param string $shortText
     * @return News
     */
    public function setShortText($shortText)
    {
        $this->shortText = $shortText;

        return $this;
    }
    
    public function getClassDestination() {
        return $this->classDestination;
    }

    public function setClassDestination($classDestination) {
        $this->classDestination = $classDestination;
    }

        /**
     * Get shortText
     *
     * @return string 
     */
    public function getShortText()
    {
        return $this->shortText;
    }

    /**
     * Set fullNewsText
     *
     * @param string $fullNewsText
     * @return News
     */
    public function setFullNewsText($fullNewsText)
    {
        $this->fullNewsText = $fullNewsText;

        return $this;
    }

    /**
     * Get fullNewsText
     *
     * @return string 
     */
    public function getFullNewsText()
    {
        return $this->fullNewsText;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return News
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return News
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set author
     *
     * @param string $author
     * @return News
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return News
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }
}
