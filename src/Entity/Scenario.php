<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ScenarioRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\ScenarioApiController;

#[ORM\Entity(repositoryClass: ScenarioRepository::class)]
#[ApiResource(collectionOperations: [
    'post' => [
        'controller' => ScenarioApiController::class,
        'deserialize' => false,
        'validation_groups' => ['Default'],
        'openapi_context' => [
            'requestBody' => [
                'content' => [
                    'multipart/form-data' => [
                        'schema' => [
                            'type' => 'object',
                            'properties' => [
                                'email' => [
                                    'type' => 'string'
                                ],
                                'phoneNumber' => [
                                    'type' => 'string'
                                ],
                                'firstname' => [
                                    'type' => 'string'
                                ],
                                'lastname' => [
                                    'type' => 'string'
                                ],
                                'file' => [
                                    'type' => 'string',
                                    'format' => 'binary',
                                ],
                                'summary' => [
                                    'type' => 'string'
                                ],
                                'stuffToAdd' => [
                                    'type' => 'string'
                                ]
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ]
], itemOperations: ['get'])]
class Scenario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $email;

    #[ORM\Column(type: 'string', length: 20)]
    private $phoneNumber;

    #[ORM\Column(type: 'string', length: 30)]
    private $firstname;

    #[ORM\Column(type: 'string', length: 40)]
    private $lastname;

    #[ORM\Column(type: 'string', length: 100)]
    private $file;

    #[ORM\Column(type: 'text')]
    private $summary;

    #[ORM\Column(type: 'text')]
    private $stuffToAdd;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(string $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(string $summary): self
    {
        $this->summary = $summary;

        return $this;
    }

    public function getStuffToAdd(): ?string
    {
        return $this->stuffToAdd;
    }

    public function setStuffToAdd(string $stuffToAdd): self
    {
        $this->stuffToAdd = $stuffToAdd;

        return $this;
    }
}
