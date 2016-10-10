<?php
/**
 * Created by PhpStorm.
 * User: pierreportejoie
 * Date: 24/08/2016
 * Time: 09:55
 */

namespace AppBundle\Entity;


use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @UniqueEntity(fields={"email"}, message="Adresse mail déjà utilisée !")
 * @UniqueEntity(fields={"name"}, message="Nom déjà utilisé !")
 */
class User implements UserInterface//, \Serializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     * @ORM\Column(type="string")
     */
    private $email;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $gender;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $nationality;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $studies;

    /**
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @Assert\NotBlank(groups={"Registration"})
     */
    private $plainPassword;

    /**
     * @ORM\Column(type="json_array")
     */
    private $roles = [];

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateRegistered;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $birthDate;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $startDate;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $mainProject;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $pitch;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     * @Assert\File(mimeTypes={ "image/*" })
     */
    private $image;

    /**
     * @ORM\Column(type="string")
     */
    private $likedCount;

    /**
     * @ORM\Column(type="string")
     */
    private $likesCount;

    /**
     * @ORM\Column(type="string")
     */
    private $views;

    public function __construct()
    {
        $date = new \DateTime();
        $this->setDateRegistered($date);
        $this->setLikedCount(0);
        $this->setLikesCount(0);
        $this->setViews(0);
    }

    public function getUsername()
    {
        return $this->name;
    }

    public function getRoles()
    {
        $roles = $this->roles;
        if (!in_array('ROLE_USER', $roles)) {
            $roles[] = 'ROLE_USER';
        }

        if (/*$this->id == */1){
            $roles[] .= 'ROLE_ADMIN';
        }

        return $roles;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getSalt()
    {
    }

    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param mixed $plainPassword
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
        //$this->password = null;
    }

    /**
     * @param mixed $roles
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
    }

    public function __toString()
    {
        return $this->getUsername();
    }

    /**
     * @return mixed
     */
    public function getDateRegistered()
    {
        return $this->dateRegistered;
    }

    /**
     * @param mixed $dateRegistered
     */
    public function setDateRegistered($dateRegistered)
    {
        $this->dateRegistered = $dateRegistered;
    }

    /**
     * @return mixed
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @param mixed $birthDate
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param mixed $startDate
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * @return mixed
     */
    public function getMainProject()
    {
        return $this->mainProject;
    }

    /**
     * @param mixed $mainProject
     */
    public function setMainProject($mainProject)
    {
        $this->mainProject = $mainProject;
    }

    /**
     * @return mixed
     */
    public function getPitch()
    {
        if ($this->pitch != null) return $this->pitch;
        else return 'Cet utilisateur n\'a encore donné aucun détail concernant son activité...';
    }

    /**
     * @param mixed $pitch
     */
    public function setPitch($pitch)
    {
        $this->pitch = $pitch;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $this->firstName+$this->lastName;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    public function serialize()
    {
        // TODO: Implement serialize() method.
    }

    public function unserialize($serialized)
    {
        // TODO: Implement unserialize() method.
    }

    /**
     * @return mixed
     */
    public function getLikedCount()
    {
        return $this->likedCount;
    }

    /**
     * @param mixed $likedCount
     */
    public function setLikedCount($likedCount)
    {
        $this->likedCount = $likedCount;
    }

    /**
     * @return mixed
     */
    public function getLikesCount()
    {
        return $this->likesCount;
    }

    /**
     * @param mixed $likesCount
     */
    public function setLikesCount($likesCount)
    {
        $this->likesCount = $likesCount;
    }

    /**
     * @return mixed
     */
    public function getViews()
    {
        return $this->views;
    }

    /**
     * @param mixed $views
     */
    public function setViews($views)
    {
        $this->views = $views;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return mixed
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * @param mixed $nationality
     */
    public function setNationality($nationality)
    {
        $this->nationality = $nationality;
    }

    /**
     * @return mixed
     */
    public function getStudies()
    {
        return $this->studies;
    }

    /**
     * @param mixed $studies
     */
    public function setStudies($studies)
    {
        $this->studies = $studies;
    }

}