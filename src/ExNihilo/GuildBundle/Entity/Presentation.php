<?php

namespace ExNihilo\GuildBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Race
 *
 * @ORM\Table(name="presentation")
 * @ORM\Entity(repositoryClass="ExNihilo\GuildBundle\Repository\PresentationRepository")
 */
class Presentation
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
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @ORM\OneToOne(targetEntity="ExNihilo\GuildBundle\Entity\ImagePresentation", cascade={"persist", "remove"})
     * @Assert\Valid()
     */
    private $imagePresentation;

    /**
     * @ORM\OneToOne(targetEntity="ExNihilo\GuildBundle\Entity\Image2Presentation", cascade={"persist", "remove"})
     * @Assert\Valid()
     */
    private $image2Presentation;

    /**
     * @ORM\OneToOne(targetEntity="ExNihilo\GuildBundle\Entity\Image3Presentation", cascade={"persist", "remove"})
     * @Assert\Valid()
     */
    private $image3Presentation;

    /**
     * @ORM\OneToOne(targetEntity="ExNihilo\GuildBundle\Entity\Image4Presentation", cascade={"persist", "remove"})
     * @Assert\Valid()
     */
    private $image4Presentation;


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

    public function setImagePresentation(ImagePresentation $imagePresentation = null)
    {
        $this->imagePresentation = $imagePresentation;
    }
    public function getImagePresentation()
    {
        return $this->imagePresentation;
    }

    public function setImage2Presentation(Image2Presentation $image2Presentation = null)
    {
        $this->image2Presentation = $image2Presentation;
    }
    public function getImage2Presentation()
    {
        return $this->image2Presentation;
    }

    public function setImage3Presentation(Image3Presentation $image3Presentation = null)
    {
        $this->image3Presentation = $image3Presentation;
    }
    public function getImage3Presentation()
    {
        return $this->image3Presentation;
    }

    public function setImage4Presentation(Image4Presentation $image4Presentation = null)
    {
        $this->image4Presentation = $image4Presentation;
    }
    public function getImage4Presentation()
    {
        return $this->image4Presentation;
    }
}
