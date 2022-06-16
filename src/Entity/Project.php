<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;
use Knp\DoctrineBehaviors\Contract\Entity\TranslationInterface;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
#[ApiResource(collectionOperations: ['get'],
    itemOperations: ['get'],
    order: ["date" => "DESC"]
)]
class Project implements TranslatableInterface
{
    use TranslatableTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $image;

    #[ORM\Column(type: 'string', length: 255)]
    private $trailer;

    #[ORM\Column(type: 'string', length: 100)]
    private $pressKit;

    #[ORM\Column(type: 'string', length: 255)]
    private $distributorLink;

    #[ORM\Column(type: 'date')]
    private $date;

    #[ORM\Column(type: 'string', length: 70)]
    private $filmmakerFullName;

    #[ORM\OneToMany(mappedBy: 'project', targetEntity: ProjectThanks::class)]
    private $projectThanks;

    public function __construct()
    {
        $this->projectThanks = new ArrayCollection();
    }

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

    public function getTrailer(): ?string
    {
        return $this->trailer;
    }

    public function setTrailer(string $trailer): self
    {
        $this->trailer = $trailer;

        return $this;
    }

    public function getPressKit(): ?string
    {
        return $this->pressKit;
    }

    public function setPressKit(string $pressKit): self
    {
        $this->pressKit = $pressKit;

        return $this;
    }

    public function getDistributorLink(): ?string
    {
        return $this->distributorLink;
    }

    public function setDistributorLink(string $distributorLink): self
    {
        $this->distributorLink = $distributorLink;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getFilmmakerFullName(): ?string
    {
        return $this->filmmakerFullName;
    }

    public function setFilmmakerFullName(string $filmmakerFullName): self
    {
        $this->filmmakerFullName = $filmmakerFullName;

        return $this;
    }

    public function getTitle(): string
    {
        return $this->translate()->getTitle();
    }

    public function getDescription(): ?string
    {
        return $this->translate()->getDescription();
    }

    public function getSection1Title(): ?string
    {
        return $this->translate()->getSection1Title();
    }

    public function getSection1Text(): ?string
    {
        return $this->translate()->getSection1Text();
    }

    public function getSection2Title(): ?string
    {
        return $this->translate()->getSection2Title();
    }

    public function getSection2Text(): ?string
    {
        return $this->translate()->getSection2Text();
    }

    /**
     * @return Collection<int, ProjectThanks>
     */
    public function getProjectThanks(): Collection
    {
        return $this->projectThanks;
    }

    public function addProjectThank(ProjectThanks $projectThank): self
    {
        if (!$this->projectThanks->contains($projectThank)) {
            $this->projectThanks[] = $projectThank;
            $projectThank->setProject($this);
        }

        return $this;
    }

    public function removeProjectThank(ProjectThanks $projectThank): self
    {
        if ($this->projectThanks->removeElement($projectThank)) {
            // set the owning side to null (unless already changed)
            if ($projectThank->getProject() === $this) {
                $projectThank->setProject(null);
            }
        }

        return $this;
    }
}
