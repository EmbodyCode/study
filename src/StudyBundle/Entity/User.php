<?php
namespace StudyBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
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
     * @ORM\Column("type=string", name="lastName", length=255)
     */
    
    private $lastName;
    
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

        public function __construct()
    {
        parent::__construct();
        // your own logic
    }
}