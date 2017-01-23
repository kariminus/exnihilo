<?php

namespace ExNihilo\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ExNihilo\PlatformBundle\Entity\Classe;
use ExNihilo\PlatformBundle\Entity\Race;
use ExNihilo\PlatformBundle\ExNihiloPlatformBundle;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="ExNihilo\UserBundle\Repository\UserRepository")
 */
class User extends BaseUser
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
     * @ORM\OneToOne(targetEntity="ExNihilo\PlatformBundle\Entity\Classe", cascade={"persist", "remove"})
     *
     * @Assert\NotBlank(message="Veuillez saisir votre classe", groups={"Registration", "Profile"})
     */
    protected $classe;

    /**
     * @ORM\OneToOne(targetEntity="ExNihilo\PlatformBundle\Entity\Race", cascade={"persist", "remove"})
     *
     * @Assert\NotBlank(message="Veuillez saisir votre race", groups={"Registration", "Profile"})
     */
    protected $race;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string")
     *
     * @Assert\NotBlank(message="Veuillez saisir votre genre", groups={"Registration", "Profile"})
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

    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * Get gender
     *
     * @return string
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

