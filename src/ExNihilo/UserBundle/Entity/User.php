<?php

namespace ExNihilo\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ExNihilo\PlatformBundle\Entity\Classe;
use ExNihilo\PlatformBundle\Entity\Race;
use Symfony\Component\Security\Core\Role\Role;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="ExNihilo\UserBundle\Repository\UserRepository")
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
     */
    private $username;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    private $email;

    /**
     * @ORM\OneToOne(targetEntity="ExNihilo\PlatformBundle\Entity\Classe", cascade={"persist", "remove"})
     *
     * @Assert\NotBlank(message="Veuillez saisir votre classe")
     */
    protected $classe;

    /**
     * @ORM\OneToOne(targetEntity="ExNihilo\PlatformBundle\Entity\Race", cascade={"persist", "remove"})
     *
     * @Assert\NotBlank(message="Veuillez saisir votre race")
     */
    protected $race;

    /**
     * @var boolean
     *
     * @ORM\Column(name="gender", type="boolean")
     *
     * @Assert\NotBlank(message="Veuillez saisir votre genre")
     */
    protected $gender;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isGuildMember", type="boolean")
     *
     * (groups={"Registration", "Profile"})
     */
    protected $isGuildMember;


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
        return ['ROLE_USER'];
    }

    public function getPassword()
    {

    }

    public function getSalt()
    {

    }

    public function eraseCredentials()
    {

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

}

