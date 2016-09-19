<?php
/**
 * Created by PhpStorm.
 * User: pierreportejoie
 * Date: 19/09/2016
 * Time: 22:32
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="notification")
 */
class Notification
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * type of notification (for now : modification, like, message)
     * @ORM\Column(type="string")
     */
    private $type;

    /**
     * object of the notification (ie. ressource, media, ...)
     * @ORM\Column(type="string", nullable=true)
     */
    private $notifObject;

    /**
     * @ORM\Column(type="integer")
     */
    private $authorId;

    /**
     * @ORM\Column(type="string")
     */
    private $message;

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
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getNotifObject()
    {
        return $this->notifObject;
    }

    /**
     * @param mixed $notifObject
     */
    public function setNotifObject($notifObject)
    {
        $this->notifObject = $notifObject;
    }

    /**
     * @return mixed
     */
    public function getAnthorId()
    {
        return $this->anthorId;
    }

    /**
     * @param mixed $anthorId
     */
    public function setAnthorId($anthorId)
    {
        $this->anthorId = $anthorId;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getAuthorId()
    {
        return $this->authorId;
    }

    /**
     * @param mixed $authorId
     */
    public function setAuthorId($authorId)
    {
        $this->authorId = $authorId;
    }


}