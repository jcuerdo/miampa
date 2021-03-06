<?php

namespace MiAmpaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ampa
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="MiAmpaBundle\Entity\AmpaRepository")
 */
class Ampa
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
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255)
     */
    private $mail;


    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;


    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=255)
     */
    private $logo;


    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * @var array
     *
     * @ORM\ManyToMany(targetEntity="User", mappedBy="ampas")
     */
    private $users;

    /**
     * @var array
     *
     * @ORM\OneToMany(targetEntity="Item", mappedBy="ampa")
     */
    private $items;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
        $this->items = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Ampa
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
     * Set address
     *
     * @param string $address
     * @return Ampa
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Ampa
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set mail
     *
     * @param string $mail
     * @return Ampa
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string 
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set logo
     *
     * @param string $logo
     * @return Ampa
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string 
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Ampa
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set slug
     *
     * @param string $password
     * @return Ampa
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     *
     * @ORM\PreUpdate
     * @ORM\PrePersist
     */
     public function preProccessDataa()
     {
        $this->setSlug($this->slugify($this->getName()));
        $this->setPassword(md5($this->getPassword()));
        $this->setLogo('');
     }

     /**
      * Sluglify method
      */
     private function slugify($string)
     {

        return str_replace(' ', '-', strtolower($string));
     }

     public function getUsers()
     {
         return $this->users;
     }
     
     public function setUsers($users)
     {
         $this->users = $users;
         return $this;
     }

    /**
     * Add users
     *
     * @param \MiAmpaBundle\Entity\User $users
     * @return Ampa
     */
    public function addUser(\MiAmpaBundle\Entity\User $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \MiAmpaBundle\Entity\User $users
     */
    public function removeUser(\MiAmpaBundle\Entity\User $users)
    {
        $this->users->removeElement($users);
    }

    public function getItems()
     {
         return $this->items;
     }
     
     public function setItems($items)
     {
         $this->items = $items;
         return $this;
     }

    /**
     * Add item
     *
     * @param \MiAmpaBundle\Entity\Item $item
     * @return Ampa
     */
    public function addItem(\MiAmpaBundle\Entity\Item $item)
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * Remove items
     *
     * @param \MiAmpaBundle\Entity\Item $item
     */
    public function removeItem(\MiAmpaBundle\Entity\Item $item)
    {
        $this->items->removeElement($item);
    }
}
