<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\BlogPostRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BlogPostRepository::class)]
#[ApiResource(collectionOperations: ['get'],
    itemOperations: ['get']
)]
class BlogPost
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $image;

    #[ORM\Column(type: 'string', length: 200)]
    private $title;

    #[ORM\Column(type: 'text')]
    private $text;

    #[ORM\Column(type: 'date')]
    private $creationdate;

    #[ORM\Column(type: 'string', length: 5)]
    private $locale;

    #[ORM\Column(type: 'string', length: 300, nullable: true)]
    private $formLink;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
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

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getCreationdate(): ?\DateTimeInterface
    {
        return $this->creationdate;
    }

    public function setCreationdate(\DateTimeInterface $creationdate): self
    {
        $this->creationdate = $creationdate;

        return $this;
    }

    public function getLocale(): ?string
    {
        return $this->locale;
    }

    public function setLocale(string $locale): self
    {
        $this->locale = $locale;

        return $this;
    }

    public function getFormLink(): ?string
    {
        return $this->formLink;
    }

    public function setFormLink(?string $formLink): self
    {
        $this->formLink = $formLink;

        return $this;
    }
}
