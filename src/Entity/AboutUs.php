<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min = 5,
     *     minMessage = "Title must be at least {{ limit }} characters long"
     * )
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 5,
     *      max = 1000,
     *      minMessage = "Short description must be at least {{ limit }} characters long",
     *      maxMessage = "Short description cannot be longer than {{ limit }} characters"
     * )
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
     * @Assert\Image(
     *     maxSize = "500K",
     *     minWidth = 350,
     *     maxWidth = 350,
     *     mimeTypes = {"image/gif", "image/jpeg", "image/jpg", "image/png"},
     *     maxSizeMessage = "Max size for this image is 500Ko.",
     *     mimeTypesMessage = ".jpg, .png or .gif are allowed."
     * )
     */
    private $imageHomeFile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     * * @Assert\Length(
     *      min = 20,
     *      minMessage = "Full description must be at least {{ limit }} characters long",
     * )
     */
    private $fullDescription;

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

    public function getFullDescription(): ?string
    {
        return $this->fullDescription;
    }

    public function setFullDescription(string $fullDescription): self
    {
        $this->fullDescription = $fullDescription;

        return $this;
    }
}
