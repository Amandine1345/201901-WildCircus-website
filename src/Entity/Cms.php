<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CmsRepository")
 * @Vich\Uploadable
 * @UniqueEntity("cmsType")
 */
class Cms
{
    const CMS_TYPE = [
        0 => 'aboutus',
        1 => 'performers',
        2 => 'performances',
        3 => 'shows'
    ];

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
     *     min = 5,
     *     max = 1000,
     *     minMessage = "Short description must be at least {{ limit }} characters long",
     *     maxMessage = "Short description cannot be longer than {{ limit }} characters"
     * )
     */
    private $shortDescription;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $fullDescription;

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
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $imageBanner;

    /**
     * @Vich\UploadableField(mapping="images", fileNameProperty="imageBanner")
     * @var File
     * @Assert\Image(
     *     maxSize = "1M",
     *     minWidth = 1300,
     *     mimeTypes = {"image/jpeg", "image/jpg", "image/png"},
     *     maxSizeMessage = "Max size for this image is 1Mo.",
     *     mimeTypesMessage = ".jpg, .png are allowed."
     * )
     */
    private $imageBannerFile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="integer", unique=true)
     */
    private $cmsType;

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

    public function getFullDescription(): ?string
    {
        return $this->fullDescription;
    }

    public function setFullDescription(?string $fullDescription): self
    {
        $this->fullDescription = $fullDescription;

        return $this;
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

    /**
     * @return File|null
     */
    public function getImageHomeFile() : ?File
    {
        return $this->imageHomeFile;
    }

    /**
     * @param File|null $imageHomeFile
     * @throws \Exception
     */
    public function setImageHomeFile(File $imageHomeFile = null) : void
    {
        $this->imageHomeFile = $imageHomeFile;

        if ($imageHomeFile) {
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageBanner(): ?string
    {
        return $this->imageBanner;
    }

    public function setImageBanner(string $imageBanner): self
    {
        $this->imageBanner = $imageBanner;

        return $this;
    }

    /**
     * @return File|null
     */
    public function getImageBannerFile() : ?File
    {
        return $this->imageBannerFile;
    }

    /**
     * @param File|null $imageBannerFile
     * @throws \Exception
     */
    public function setImageBannerFile(File $imageBannerFile = null) : void
    {
        $this->imageBannerFile = $imageBannerFile;

        if ($imageBannerFile) {
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getCmsTypeKey(string $cms_type): ?int
    {
        return array_search($cms_type, self::CMS_TYPE);
    }

    public function setCmsType(int $cmsType): self
    {
        $this->cmsType = $cmsType;

        return $this;
    }

    public function getAuthorizedCmsToViewInput(string $cms_type): bool
    {
        $cmsAuthorized = ['aboutus'];
        return in_array($cms_type, $cmsAuthorized);
    }
}
