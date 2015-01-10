<?php

namespace MiAmpaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PrivateMessage
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class PrivateMessage
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="string", length=255)
     */
    private $message;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;


    /**
     * @ORM\OneToOne(targetEntity="User")
     *
     */
    private $sender;

    /**
     * @ORM\OneToOne(targetEntity="User")
     *
     */
    private $receiver;


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
     * Set message
     *
     * @param string $message
     * @return PrivateMessage
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return PrivateMessage
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

    public function getSender()
    {
        return $this->sender;
    }
    
    public function setSender($sender)
    {
        $this->sender = $sender;
        return $this;
    }

    public function getReceiver()
    {
        return $this->receiver;
    }
    
    public function setReceiver($receiver)
    {
        $this->receiver = $receiver;
        return $this;
    }

    /**
     *
     * @ORM\PrePersist
     */
     public function preProccessDataa()
     {
        $this->setDate(new \DateTime());
     }
}
