<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PerformerRepository")
 * @UniqueEntity("name")
 * @Vich\Uploadable
 */
class Performer
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
     *     minMessage = "Title must be at least {{ limit }} characters long"
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $biography;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $birthday;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $picture;

    /**
     * @Vich\UploadableField(mapping="performers", fileNameProperty="picture")
     * @var File
     * @Assert\Image(
     *     maxSize = "500K",
     *     minWidth = 350,
     *     maxWidth = 350,
     *     minHeight = 350,
     *     maxHeight = 350,
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
     * @ORM\Column(type="string", length=5)
     */
    private $countryIso;

    /**
     * @var string
     */
    private $countryName;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Performance", mappedBy="performers")
     */
    private $performances;

    public function __construct()
    {
        $this->performances = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getBiography(): ?string
    {
        return $this->biography;
    }

    public function setBiography(?string $biography): self
    {
        $this->biography = $biography;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(?\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

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
     * @return File
     */
    public function getPictureFile(): ?File
    {
        return $this->pictureFile;
    }

    /**
     * @param File|null $pictureFile
     * @return Performer
     * @throws \Exception
     */
    public function setPictureFile(File $pictureFile = null): Performer
    {
        $this->pictureFile = $pictureFile;
        if ($pictureFile) {
            $this->updatedAt = new \DateTime('now');
        }
        return $this;
    }

    public function getCountryIso(): ?string
    {
        return $this->countryIso;
    }

    public function setCountryIso(string $countryIso): self
    {
        $this->countryIso = $countryIso;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCountryName() : ?string
    {
        return $this->countryName;
    }

    /**
     * @param mixed $countryName
     * @return Performer
     */
    public function setCountryName(string $countryName): Performer
    {
        $this->countryName = $countryName;
        return $this;
    }

    /**
     * @return Collection|Performance[]
     */
    public function getPerformances(): Collection
    {
        return $this->performances;
    }

    public function addPerformance(Performance $performance): self
    {
        if (!$this->performances->contains($performance)) {
            $this->performances[] = $performance;
            $performance->addPerformer($this);
        }

        return $this;
    }

    public function removePerformance(Performance $performance): self
    {
        if ($this->performances->contains($performance)) {
            $this->performances->removeElement($performance);
            $performance->removePerformer($this);
        }

        return $this;
    }
}
