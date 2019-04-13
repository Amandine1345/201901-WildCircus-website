<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PriceRepository")
 */
class Price
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank()
     * @Assert\GreaterThanOrEqual(0)
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PricePeriod")
     * @ORM\JoinColumn(nullable=false)
     */
    private $period;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PriceCategory")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getPeriod(): ?PricePeriod
    {
        return $this->period;
    }

    public function setPeriod(?PricePeriod $period): self
    {
        $this->period = $period;

        return $this;
    }

    public function getCategory(): ?PriceCategory
    {
        return $this->category;
    }

    public function setCategory(?PriceCategory $category): self
    {
        $this->category = $category;

        return $this;
    }
}
