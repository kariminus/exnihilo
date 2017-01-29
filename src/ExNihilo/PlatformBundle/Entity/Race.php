<?php

namespace ExNihilo\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\OneToOne(targetEntity="ExNihilo\PlatformBundle\Entity\ImageRaceHomme", cascade={"persist", "remove"})
     * @Assert\Valid()
     */
    private $imageRaceHomme;

    /**
     * @ORM\OneToOne(targetEntity="ExNihilo\PlatformBundle\Entity\ImageRaceFemme", cascade={"persist", "remove"})
     * @Assert\Valid()
     */
    private $imageRaceFemme;

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

    public function setImageRaceHomme(ImageRaceHomme $imageRaceHomme = null)
    {
        $this->imageRaceHomme = $imageRaceHomme;
    }
    public function getImageRaceHomme()
    {
        return $this->imageRaceHomme;
    }

    public function setImageRaceFemme(ImageRaceFemme $imageRaceFemme = null)
    {
        $this->imageRaceFemme = $imageRaceFemme;
    }
    public function getImageRaceFemme()
    {
        return $this->imageRaceFemme;
    }
}

