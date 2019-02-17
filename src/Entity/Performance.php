<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\OrderBy;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PerformanceRepository")
 * @UniqueEntity("name")
 * @Vich\Uploadable
 */
class Performance
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min = 5,
     *     minMessage = "Name must be at least {{ limit }} characters long"
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $picture;

    /**
     * @Vich\UploadableField(mapping="performances", fileNameProperty="picture")
     * @var File
     * @Assert\Image(
     *     maxSize = "1M",
     *     minWidth = 450,
     *     maxWidth = 450,
     *     minHeight = 250,
     *     maxHeight = 250,
     *     mimeTypes = {"image/jpeg", "image/jpg", "image/png"},
     *     maxSizeMessage = "Max size for this image is 500Ko.",
     *     mimeTypesMessage = ".jpg or .png are allowed."
     * )
     */
    private $pictureFile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Performer", inversedBy="performances", cascade={"persist"})
     * @OrderBy({"name" = "ASC"})
     */
    private $performers;

    public function __construct()
    {
        $this->performers = new ArrayCollection();
    }

    /**
     * @Groups("performance")
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @Groups("performance")
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return File|null
     */
    public function getPictureFile(): ?File
    {
        return $this->pictureFile;
    }

    /**
     * @param File|null $pictureFile
     * @return Performance
     * @throws \Exception
     */
    public function setPictureFile(File $pictureFile = null): Performance
    {
        $this->pictureFile = $pictureFile;

        if ($pictureFile) {
            $this->updatedAt = new \DateTime('now');
        }

        return $this;
    }

    /**
     * @return Collection|Performer[]
     */
    public function getPerformers(): Collection
    {
        return $this->performers;
    }

    public function addPerformer(Performer $performer): self
    {
        if (!$this->performers->contains($performer)) {
            $this->performers[] = $performer;
        }

        return $this;
    }

    public function removePerformer(Performer $performer): self
    {
        if ($this->performers->contains($performer)) {
            $this->performers->removeElement($performer);
        }

        return $this;
    }
}
