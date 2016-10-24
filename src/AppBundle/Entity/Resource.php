<?php
/**
 * Created by PhpStorm.
 * User: pierreportejoie
 * Date: 26/08/2016
 * Time: 18:31
 */

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="resource")
 */
class Resource
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    //MANDATORY FIELDS
    /**
     * @ORM\Column(type="string", unique=true)
     */
    private $name;
    /**
     * @ORM\Column(type="string")
     */

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     * @Assert\File(mimeTypes={ "image/*" })
     */
    private $image;

    private $category;
    /**
     * @ORM\Column(type="string")
     */
    private $company;
    /**
     * @ORM\Column(type="string")
     */
    private $address;
    /**
     * @ORM\Column(type="string")
     */
    private $GPSLat;
    /**
     * @ORM\Column(type="string")
     */
    private $GPSLong;
    /**
     * @ORM\Column(type="string")
     */
    private $website;
    /**
     * @ORM\Column(type="text")
     */
    private $description;

    //OPTIONAL FIELDS
    /**
     * @ORM\Column(type="string")
     */
    private $phone;
    /**
     * @ORM\Column(type="string")
     */
    private $email;
    /**
     * @ORM\Column(type="string")
     */
    private $openingTime;
    /**
     * @ORM\Column(type="string")
     */
    private $twitter;
    /**
     * @ORM\Column(type="string")
     */
    private $facebook;
    /**
     * @ORM\Column(type="string")
     */
    private $linkedin;
    /**
     * @ORM\Column(type="simple_array")
     */
    private $tags;

    /**
     * @ORM\Column(type="integer")
     */
    private $likesCount = 0;

    /**
     * @ORM\Column(type="string")
     */
    private $views;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    private $submittedBy;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param mixed $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getGPSLat()
    {
        return $this->GPSLat;
    }

    /**
     * @param mixed $GPSLat
     */
    public function setGPSLat($GPSLat)
    {
        $this->GPSLat = $GPSLat;
    }

    /**
     * @return mixed
     */
    public function getGPSLong()
    {
        return $this->GPSLong;
    }

    /**
     * @param mixed $GPSLong
     */
    public function setGPSLong($GPSLong)
    {
        $this->GPSLong = $GPSLong;
    }

    /**
     * @return mixed
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * @param mixed $website
     */
    public function setWebsite($website)
    {
        $this->website = $website;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
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
    public function getOpeningTime()
    {
        return $this->openingTime;
    }

    /**
     * @param mixed $openingTime
     */
    public function setOpeningTime($openingTime)
    {
        $this->openingTime = $openingTime;
    }

    /**
     * @return mixed
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * @param mixed $twitter
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;
    }

    /**
     * @return mixed
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * @param mixed $facebook
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;
    }

    /**
     * @return mixed
     */
    public function getLinkedin()
    {
        return $this->linkedin;
    }

    /**
     * @param mixed $linkedin
     */
    public function setLinkedin($linkedin)
    {
        $this->linkedin = $linkedin;
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param mixed $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
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

    /**
     * @return mixed
     */
    public function getSubmittedBy()
    {
        return $this->submittedBy;
    }

    /**
     * @param mixed $submittedBy
     */
    public function setSubmittedBy($submittedBy)
    {
        $this->submittedBy = $submittedBy;
    }

}