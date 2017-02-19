<?php

namespace StudyBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
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
     * @ORM\Column(type="integer", name="average")
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

}
