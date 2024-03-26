<?php

namespace App\Entity;

use App\Repository\JobOfferRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JobOfferRepository::class)]
class JobOffer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $reference = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $jobtitle = null;

    #[ORM\Column(length: 255)]
    private ?string $jobtype = null;

    #[ORM\ManyToOne(inversedBy: 'jobOffers')]
    private ?JobCategory $category = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $createdZt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): static
    {
        $this->reference = $reference;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getJobtitle(): ?string
    {
        return $this->jobtitle;
    }

    public function setJobtitle(string $jobtitle): static
    {
        $this->jobtitle = $jobtitle;

        return $this;
    }

    public function getJobtype(): ?string
    {
        return $this->jobtype;
    }

    public function setJobtype(string $jobtype): static
    {
        $this->jobtype = $jobtype;

        return $this;
    }

    public function getCategory(): ?JobCategory
    {
        return $this->category;
    }

    public function setCategory(?JobCategory $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getCreatedZt(): ?\DateTimeInterface
    {
        return $this->createdZt;
    }

    public function setCreatedZt(\DateTimeInterface $createdZt): static
    {
        $this->createdZt = $createdZt;

        return $this;
    }
}
