<?php

namespace ExNihilo\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use ExNihilo\UserBundle\Entity\User;

/**
 * Class
 *
 * @ORM\Table(name="classe")
 * @ORM\Entity(repositoryClass="ExNihilo\PlatformBundle\Repository\ClasseRepository")
 */
class Classe
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
     * @ORM\OneToOne(targetEntity="ExNihilo\PlatformBundle\Entity\ImageClasse", cascade={"persist", "remove"})
     * @Assert\Valid()
     */
    private $imageClasse;

    /**
     *
     * @ORM\OneToMany(targetEntity="ExNihilo\UserBundle\Entity\User", mappedBy="classe")
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
     * @return Classe
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

    public function setImageClasse(ImageClasse $imageClasse = null)
    {
        $this->imageClasse = $imageClasse;
    }
    public function getImageClasse()
    {
        return $this->imageClasse;
    }

    /**
     * @param User $user
     */
    public function addUser(User $user)
    {
        $this->users[] = $user;
        $user->setClasse($this);
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

