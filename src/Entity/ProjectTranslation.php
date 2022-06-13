<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProjectRepository;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TranslationInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslationTrait;

#[ORM\Entity]
class ProjectTranslation implements TranslationInterface
{
    use TranslationTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 50)]
    private string $title;

    #[ORM\Column(type: 'text')]
    private string $description;

    #[ORM\Column(type: 'string', length: 50)]
    private string $section1Title;

    #[ORM\Column(type: 'text')]
    private string $section1Text;

    #[ORM\Column(type: 'string', length: 50)]
    private string $section2Title;

    #[ORM\Column(type: 'text')]
    private string $section2Text;

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getSection1Title(): ?string
    {
        return $this->section1Title;
    }

    public function setSection1Title(string $section1Title): self
    {
        $this->section1Title = $section1Title;

        return $this;
    }

    public function getSection1Text(): ?string
    {
        return $this->section1Text;
    }

    public function setSection1Text(string $section1Text): self
    {
        $this->section1Text = $section1Text;

        return $this;
    }

    public function getSection2Title(): ?string
    {
        return $this->section2Title;
    }

    public function setSection2Title(string $section2Title): self
    {
        $this->section2Title = $section2Title;

        return $this;
    }

    public function getSection2Text(): ?string
    {
        return $this->section2Text;
    }

    public function setSection2Text(string $section2Text): self
    {
        $this->section2Text = $section2Text;

        return $this;
    }
}