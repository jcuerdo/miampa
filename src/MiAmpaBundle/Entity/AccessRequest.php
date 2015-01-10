<?php

namespace MiAmpaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AccessRequest
 *
 * @ORM\Table()
 * @ORM\HasLifecycleCallbacks
 */
class AccessRequest
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255, options={"default" = "published"})
     */
    private $status;


    /**
     * @ORM\OneToOne(targetEntity="Ampa")
     *
     */
    private $ampa;

    /**
     * @ORM\OneToOne(targetEntity="User")
     *
     */
    private $user;

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
     * Set date
     *
     * @param \DateTime $date
     * @return AccessRequest
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
     * Set status
     *
     * @param string $status
     * @return AccessRequest
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

    public function getAmpa()
    {
        return $this->ampa;
    }
    
    public function setAmpa($ampa)
    {
        $this->ampa = $ampa;
        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }
    
    public function setUser($user)
    {
        $this->user = $user;
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
