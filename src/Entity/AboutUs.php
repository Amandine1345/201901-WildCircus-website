<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AboutUsRepository")
 * @Vich\Uploadable
 */
class AboutUs
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $shortDescription;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $imageHome;

    /**
     * @Vich\UploadableField(mapping="images", fileNameProperty="imageHome")
     * @var File
     */
    private $imageHomeFile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime
     */
    private $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(string $shortDescription): self
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    /**
     * @return File
     */
    public function getImageHomeFile(): ?File
    {
        return $this->imageHomeFile;
    }

    /**
     * @param File|null $imageHomeFile
     * @throws \Exception
     */
    public function setImageHomeFile(File $imageHomeFile = null): void
    {
        $this->imageHomeFile = $imageHomeFile;

        if ($imageHomeFile) {
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageHome(): ?string
    {
        return $this->imageHome;
    }

    public function setImageHome(?string $imageHome): self
    {
        $this->imageHome = $imageHome;

        return $this;
    }
}
