<?php

namespace ExNihilo\GuildBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\OneToOne(targetEntity="ExNihilo\GuildBundle\Entity\GuildImage1", cascade={"persist", "remove"})
     * @Assert\Valid()
     */
    private $guildImage1;


    /**
     * @ORM\OneToOne(targetEntity="ExNihilo\GuildBundle\Entity\GuildImage2", cascade={"persist", "remove"})
     * @Assert\Valid()
     */
    private $guildImage2;

    /**
     * @ORM\OneToOne(targetEntity="ExNihilo\GuildBundle\Entity\GuildImage3", cascade={"persist", "remove"})
     * @Assert\Valid()
     */
    private $guildImage3;

    /**
     * @ORM\OneToOne(targetEntity="ExNihilo\GuildBundle\Entity\GuildImage4", cascade={"persist", "remove"})
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


    public function setGuildImage1(GuildImage1 $guildImage1 = null)
    {
        $this->guildImage1 = $guildImage1;
    }
    public function getGuildImage1()
    {
        return $this->guildImage1;
    }

    public function setGuildImage2(GuildImage2 $guildImage2 = null)
    {
        $this->guildImage2 = $guildImage2;
    }
    public function getGuildImage2()
    {
        return $this->guildImage2;
    }

    public function setGuildImage3(GuildImage3 $guildImage3 = null)
    {
        $this->guildImage3 = $guildImage3;
    }

    public function getGuildImage3()
    {
        return $this->guildImage3;
    }

    public function setGuildImage4(GuildImage4 $guildImage4 = null)
    {
        $this->guildImage4 = $guildImage4;
    }
    public function getGuildImage4()
    {
        return $this->guildImage4;
    }

}

