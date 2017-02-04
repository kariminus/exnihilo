<?php

namespace ExNihilo\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use ExNihilo\UserBundle\Entity\User;

/**
 * Race
 *
 * @ORM\Table(name="race")
 * @ORM\Entity(repositoryClass="ExNihilo\PlatformBundle\Repository\RaceRepository")
 */
class Race
{
    /**
     * @var int
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
     *
     * @ORM\OneToMany(targetEntity="ExNihilo\UserBundle\Entity\User", mappedBy="race")
     */
    private $users;

    public function __construct() {

        $this->users = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Race
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
     * @param User $user
     */
    public function addUser(User $user)
    {
        $this->users[] = $user;
        $user->setrace($this);
    }
    /**
     * @param User $user
     */
    public function removeUser(User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }
}

