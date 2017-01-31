<?php

namespace ExNihilo\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ExNihilo\PlatformBundle\Entity\Classe;
use ExNihilo\PlatformBundle\Entity\Race;
use ExNihilo\EventBundle\Entity\Event;
use Symfony\Component\Security\Core\Role\Role;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="ExNihilo\UserBundle\Repository\UserRepository")
 * @UniqueEntity(fields={"email"}, message="Ce mail est déjà utilisé")
 * @UniqueEntity(fields={"username"}, message="Ce membre existe déjà")
 */
class User implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", unique=true)
     * @Assert\NotBlank()
     */
    private $username;

    /**
     * @ORM\Column(type="string", unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     *
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     *
     * @var string
     * @Assert\NotBlank(groups={"Registration"})
     */
    private $plainPassword;

    /**
     * @ORM\Column(type="json_array")
     */
    private $roles = [];

    /**
     * @ORM\ManyToOne(targetEntity="ExNihilo\PlatformBundle\Entity\Classe", inversedBy="users")
     * @ORM\JoinColumn(name="classe_id", referencedColumnName="id")
     */
    private $classe;

    /**
     * @ORM\OneToOne(targetEntity="ExNihilo\PlatformBundle\Entity\Race", cascade={"persist", "remove"})
     *
     */
    protected $race;

    /**
     * @var boolean
     *
     * @ORM\Column(name="gender", type="boolean")
     *
     */
    protected $gender;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isGuildMember", type="boolean")
     *
     */
    protected $isGuildMember;

    /**
     * @ORM\ManyToMany(targetEntity="ExNihilo\EventBundle\Entity\Event", inversedBy="users")
     * @ORM\JoinTable(name="users_events")
     */
    private $events;

    public function __construct() {

        $this->events = new ArrayCollection();
        $this->setRoles(['ROLE_USER']);
    }


    public function getId()
    {
        return $this->id;
    }


    public function setId($id)
    {
        $this->id = $id;
    }


    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }


    public function getEmail()
    {
        return $this->email;
    }


    public function setEmail($email)
    {
        $this->email = $email;
    }



    public function getRoles()
    {
        $roles = $this->roles;
        if (!in_array('ROLE_USER', $roles)) {
            $roles[] = 'ROLE_USER';
        }
        return $roles;
    }

    public function setRoles(array $roles)
    {
        $this->roles = $roles;
    }

    public function getPassword()
    {
        return $this->password;
    }


    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }


    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
        $this->password = null;
    }


    public function getSalt()
    {

    }

    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }

    public function setClasse(Classe $classe)
    {
        $this->classe = $classe;
    }


    public function getClasse()
    {
        return $this->classe;
    }

    public function setRace(Race $race)
    {
        $this->race = $race;
    }

    public function getRace()
    {
        return $this->race;
    }

    /**
     * Set gender
     *
     * @param boolean $gender
     *
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * Get gender
     *
     * @return boolean
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set isGuildMember
     *
     * @param boolean $isGuildMember
     *
     */
    public function setIsGuildMember($isGuildMember)
    {
        $this->isGuildMember = $isGuildMember;
    }

    /**
     * Get isGuildMember
     *
     * @return boolean
     */
    public function getIsGuildMember()
    {
        return $this->isGuildMember;
    }

    /**
     * @param Event $event
     */
    public function addEvent(Event $event)
    {
        $this->events[] = $event;
    }
    /**
     * @param Event $event
     */
    public function removeEvent(Event $event)
    {
        $this->events->removeElement($event);
    }
    /**
     * @return ArrayCollection
     */
    public function getEvents()
    {
        return $this->events;
    }

}

