<?php

namespace MiAmpaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Item
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Item
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="points", type="string", length=255)
     */
    private $points;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255, options={"default" = "published"},nullable=true)
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="Ampa", inversedBy="items")
     */
    private $ampa;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     *
     */
    private $publisher;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     *
     */
    private $buyer;

    /**
     * @ORM\OneToMany(targetEntity="ItemMessage", mappedBy="item")
     *
     */
    private $messages;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->messages = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Item
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Item
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set points
     *
     * @param string $points
     * @return Item
     */
    public function setPoints($points)
    {
        $this->points = $points;

        return $this;
    }

    /**
     * Get points
     *
     * @return string 
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Item
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Item
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

    public function getAmpa()
    {
        return $this->ampa;
    }
    
    public function setAmpa($ampa)
    {
        $this->ampa = $ampa;
        return $this;
    }

    public function getPublisher()
    {
        return $this->publisher;
    }
    
    public function setPublisher($publisher)
    {
        $this->publisher = $publisher;
        return $this;
    }

    public function getBuyer()
    {
        return $this->buyer;
    }
    
    public function setBuyer($buyer)
    {
        $this->buyer = $buyer;
        return $this;
    }

    public function getMessages()
    {
        return $this->messages;
    }
     
    public function setMessages($messages)
    {
        $this->messages = $messages;
        return $this;
    }

    /**
     *
     * @ORM\PrePersist
     */
     public function preProccessData()
     {
        $this->setDate(new \DateTime());
     }
}
