<?php

namespace StudyBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\Util\SecureRandom;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", name="firstName", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", name="lastName", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(type="integer", name="class")
     */
    private $class;

    /**
     * @ORM\Column(type="string", name="faculty", length=255)
     */
    private $faculty;

    /**
     * @ORM\Column(type="string", name="speciality", length=255)
     */
    private $speciality;

    /**
     * @ORM\Column(type="float", name="average")
     */
    private $average;

    /**
     * @ORM\Column(type="integer", name="attendance")
     */
    private $attendance;

    /**
     * @ORM\Column(type="string", name="status")
     */
    private $status;

    /**
     * @Assert\File(maxSize="2048k")
     * @Assert\Image(mimeTypesMessage="Please upload a valid image.")
     */
    protected $profilePictureFile;
    // for temporary storage
    private $tempProfilePicturePath;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $profilePicturePath;

    public function getFirstName() {
        return $this->firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function getClass() {
        return $this->class;
    }

    public function getFaculty() {
        return $this->faculty;
    }

    public function getPath() {
        return $this->path;
    }

    public function setPath($path) {
        $this->path = $path;
    }

    public function getSpeciality() {
        return $this->speciality;
    }

    public function getAverage() {
        return $this->average;
    }

    public function getAttendance() {
        return $this->attendance;
    }

    public function setClass($class) {
        $this->class = $class;
    }

    public function setFaculty($faculty) {
        $this->faculty = $faculty;
    }

    public function setSpeciality($speciality) {
        $this->speciality = $speciality;
    }

    public function setAverage($average) {
        $this->average = $average;
    }

    public function setAttendance($attendance) {
        $this->attendance = $attendance;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function __construct() {
        parent::__construct();
        // your own logic
    }

    /**
     * Sets the file used for profile picture uploads
     * 
     * @param UploadedFile $file
     * @return object
     */
    public function setProfilePictureFile(UploadedFile $file = null) {
        // set the value of the holder
        $this->profilePictureFile = $file;
        // check if we have an old image path
        if (isset($this->profilePicturePath)) {
            // store the old name to delete after the update
            $this->tempProfilePicturePath = $this->profilePicturePath;
            $this->profilePicturePath = null;
        } else {
            $this->profilePicturePath = 'initial';
        }

        return $this;
    }

    /**
     * Get the file used for profile picture uploads
     * 
     * @return UploadedFile
     */
    public function getProfilePictureFile() {

        return $this->profilePictureFile;
    }

    /**
     * Set profilePicturePath
     *
     * @param string $profilePicturePath
     * @return User
     */
    public function setProfilePicturePath($profilePicturePath) {
        $this->profilePicturePath = $profilePicturePath;

        return $this;
    }

    /**
     * Get profilePicturePath
     *
     * @return string 
     */
    public function getProfilePicturePath() {
        return $this->profilePicturePath;
    }

    /**
     * Get the absolute path of the profilePicturePath
     */
    public function getProfilePictureAbsolutePath() {
        return null === $this->profilePicturePath ? null : $this->getUploadRootDir() . '/' . $this->profilePicturePath;
    }

    /**
     * Get root directory for file uploads
     * 
     * @return string
     */
    protected function getUploadRootDir($type = 'profilePicture') {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__ . '/../../../web/' . $this->getUploadDir($type);
    }

    /**
     * Specifies where in the /web directory profile pic uploads are stored
     * 
     * @return string
     */
    protected function getUploadDir($type = 'profilePicture') {
        // the type param is to change these methods at a later date for more file uploads
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/user/profilepics';
    }

    /**
     * Get the web path for the user
     * 
     * @return string
     */
    public function getWebProfilePicturePath() {

        return '/' . $this->getUploadDir() . '/' . $this->getProfilePicturePath();
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUploadProfilePicture() {
        if (null !== $this->getProfilePictureFile()) {
            // a file was uploaded
            // generate a unique filename
            $filename = $this->generateRandomProfilePictureFilename();
            $this->setProfilePicturePath($filename . '.' . $this->getProfilePictureFile()->guessExtension());
        }
    }

    /**
     * Generates a 32 char long random filename
     * 
     * @return string
     */
    public function generateRandomProfilePictureFilename() {
        $count = 0;
        do {
            $generator = new SecureRandom();
            $random = $generator->nextBytes(16);
            $randomString = bin2hex($random);
            $count++;
        } while (file_exists($this->getUploadRootDir() . '/' . $randomString . '.' . $this->getProfilePictureFile()->guessExtension()) && $count < 50);

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
    public function uploadProfilePicture() {
        // check there is a profile pic to upload
        if ($this->getProfilePictureFile() === null) {
            return;
        }
        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->getProfilePictureFile()->move($this->getUploadRootDir(), $this->getProfilePicturePath());

        // check if we have an old image
        if (isset($this->tempProfilePicturePath) && file_exists($this->getUploadRootDir() . '/' . $this->tempProfilePicturePath)) {
            // delete the old image
            unlink($this->getUploadRootDir() . '/' . $this->tempProfilePicturePath);
            // clear the temp image path
            $this->tempProfilePicturePath = null;
        }
        $this->profilePictureFile = null;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeProfilePictureFile() {
        if ($file = $this->getProfilePictureAbsolutePath() && file_exists($this->getProfilePictureAbsolutePath())) {
            unlink($file);
        }
    }
}