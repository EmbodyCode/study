<?php

namespace StudyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\Util\SecureRandom;

/**
 * Events
 * 
 * @ORM\Table(name="events")
 * @ORM\Entity(repositoryClass="StudyBundle\Repository\EventsRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Events
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $eventPicturePath;

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
     * @Assert\File(maxSize="2048k")
     * @Assert\Image(mimeTypesMessage="Please upload a valid image.")
     */
    protected $eventPictureFile;
    // for temporary storage
    private $tempEventPicturePath;
    
    /**
     * Sets the file used for profile picture uploads
     * 
     * @param UploadedFile $file
     * @return object
     */
    public function setEventPictureFile(UploadedFile $file = null) {
        // set the value of the holder
        $this->eventPictureFile = $file;

        return $this;
    }
    
    
     /**
     * Get the file used for profile picture uploads
     * 
     * @return UploadedFile
     */
    public function getEventPictureFile() {

        return $this->eventPictureFile;
    }

    /**
     * Get the absolute path of the profilePicturePath
     */
    public function getEventPictureAbsolutePath() {
        return null === $this->eventPicturePath ? null : $this->getUploadRootDir() . '/' . $this->eventPicturePath;
    }
    
    /**
     * Get root directory for file uploads
     * 
     * @return string
     */
    protected function getUploadRootDir($type = 'eventPicture') {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__ . '/../../../web/' . $this->getUploadDir($type);
    }

    /**
     * Specifies where in the /web directory profile pic uploads are stored
     * 
     * @return string
     */
    protected function getUploadDir($type = 'eventPicture') {
        // the type param is to change these methods at a later date for more file uploads
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/user/eventpics';
    }

    /**
     * Get the web path for the user
     * 
     * @return string
     */
    public function getWebEventPicturePath() {

        return '/' . $this->getUploadDir() . '/' . $this->getEventPicturePath();
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUploadEventPicture() {
        if (null !== $this->getEventPictureFile()) {
            // a file was uploaded
            // generate a unique filename
            $filename = $this->generateRandomEventPictureFilename();
            $this->setEventPicturePath($filename . '.' . $this->getEventPictureFile()->guessExtension());
        }
    }

    /**
     * Generates a 32 char long random filename
     * 
     * @return string
     */
    public function generateRandomEventPictureFilename() {
        $count = 0;
        do {
            $generator = new SecureRandom();
            $random = $generator->nextBytes(16);
            $randomString = bin2hex($random);
            $count++;
        } while (file_exists($this->getUploadRootDir() . '/' . $randomString . '.' . $this->getEventPictureFile()->guessExtension()) && $count < 50);

        return $randomString;
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     * 
     * Upload the profile picture
     * 
     * @return mixed
     */
    public function uploadEventPicture() {
        // check there is a profile pic to upload
        if ($this->getEventPictureFile() === null) {
            return;
        }
        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->getEventPictureFile()->move($this->getUploadRootDir(), $this->getEventPicturePath());

        // check if we have an old image
        if (isset($this->tempEventPicturePath) && file_exists($this->getUploadRootDir() . '/' . $this->tempEventPicturePath)) {
            // delete the old image
            unlink($this->getUploadRootDir() . '/' . $this->tempEventPicturePath);
            // clear the temp image path
            $this->tempEventPicturePath = null;
        }
        $this->eventPictureFile = null;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeEventPictureFile() {
        if ($file = $this->getEventPictureAbsolutePath() && file_exists($this->getEventPictureAbsolutePath())) {
            unlink($file);
        }
    }


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
     * @return Events
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
     * Set date
     *
     * @param \DateTime $date
     * @return Events
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set eventPicturePath
     *
     * @param string $eventPicturePath
     * @return Events
     */
    public function setEventPicturePath($eventPicturePath)
    {
        $this->eventPicturePath = $eventPicturePath;

        return $this;
    }

    /**
     * Get eventPicturePath
     *
     * @return string 
     */
    public function getEventPicturePath()
    {
        return $this->eventPicturePath;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Events
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
     * @param string $updatedAt
     * @return Events
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return string 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
