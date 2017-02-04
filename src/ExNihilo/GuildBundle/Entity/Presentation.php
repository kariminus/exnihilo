<?php

namespace ExNihilo\GuildBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
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
     * @ORM\OneToMany(targetEntity="ExNihilo\GuildBundle\Entity\ImagePresentation", cascade={"persist", "remove"}, mappedBy="presentation")
     * @Assert\Valid()
     */
    private $imagePresentations;

    public function __construct()
    {
        $this->imagePresentations = new ArrayCollection();
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

    /**
     * @param ImagePresentation $imagePresentation
     */
    public function addImagePresentation(ImagePresentation $imagePresentation)
    {
        $this->imagePresentations[] = $imagePresentation;
        $imagePresentation->setPresentation($this);
    }
    /**
     * @param  ImagePresentation $imagePresentation
     */
    public function removeImagePresentation(ImagePresentation $imagePresentation)
    {
        $this->imagePresentations->removeElement($imagePresentation);
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImagePresentations()
    {
        return $this->imagePresentations;
    }

}
