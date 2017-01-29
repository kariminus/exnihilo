<?php

namespace ExNihilo\GuildBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ExNihilo\BlogBundle\Entity\Image;

/**
 * Presentation
 */
class Presentation
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $content;

    /**
     * @ORM\OneToOne(targetEntity="ExNihilo\BlogBundle\Entity\Image", cascade={"persist", "remove"})
     * @Assert\Valid()
     */
    private $guildImage1;


    /**
     * @ORM\OneToOne(targetEntity="ExNihilo\BlogBundle\Entity\Image", cascade={"persist", "remove"})
     * @Assert\Valid()
     */
    private $guildImage2;

    /**
     * @ORM\OneToOne(targetEntity="ExNihilo\BlogBundle\Entity\Image", cascade={"persist", "remove"})
     * @Assert\Valid()
     */
    private $guildImage3;

    /**
     * @ORM\OneToOne(targetEntity="ExNihilo\BlogBundle\Entity\Image", cascade={"persist", "remove"})
     * @Assert\Valid()
     */
    private $guildImage4;

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
     * Set content
     *
     * @param string $content
     *
     * @return Presentation
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }


    public function setGuildImage1(Image $image = null)
    {
        $this->guildImage1 = $image;
    }
    public function getGuildImage1()
    {
        return $this->guildImage1;
    }

    public function setGuildImage2(Image $image = null)
    {
        $this->guildImage2 = $image;
    }
    public function getGuildImage2()
    {
        return $this->guildImage2;
    }

    public function setGuildImage3(Image $image = null)
    {
        $this->guildImage3 = $image;
    }

    public function getGuildImage3()
    {
        return $this->guildImage3;
    }

    public function setGuildImage4(Image $image = null)
    {
        $this->guildImage4 = $image;
    }
    public function getGuildImage4()
    {
        return $this->guildImage4;
    }

}

