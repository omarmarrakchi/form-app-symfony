<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(name: 'questiontext', length: 255)]
    private ?string $questionText = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\ManyToOne(targetEntity: Form::class, inversedBy: 'questions')]
    #[ORM\JoinColumn(name: 'idform', nullable: false)]
    private ?Form $idForm = null;

    #[ORM\OneToMany(targetEntity: Radiooption::class, mappedBy: 'idQuestion', cascade: ['persist'], orphanRemoval: true)]
    private Collection $radiooptions;

    #[ORM\OneToMany(targetEntity: Responseform::class, mappedBy: 'idQuestion', cascade: ['persist'], orphanRemoval: true)]
    private Collection $responses;

    public function __construct()
    {
        $this->radiooptions = new ArrayCollection();
        $this->responses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestionText(): ?string
    {
        return $this->questionText;
    }

    public function setQuestionText(string $questionText): self
    {
        $this->questionText = $questionText;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getIdForm(): ?Form
    {
        return $this->idForm;
    }

    public function setIdForm(?Form $idForm): self
    {
        $this->idForm = $idForm;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getRadiooptions(): Collection
    {
        return $this->radiooptions;
    }

    public function addRadiooption(Radiooption $radiooption): self
    {
        if (!$this->radiooptions->contains($radiooption)) {
            $this->radiooptions[] = $radiooption;
            $radiooption->setIdQuestion($this);
        }

        return $this;
    }

    public function removeRadiooption(Radiooption $radiooption): self
    {
        if ($this->radiooptions->removeElement($radiooption)) {
            // set the owning side to null (unless already changed)
            if ($radiooption->getIdQuestion() === $this) {
                $radiooption->setIdQuestion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection
     */
    public function getResponses(): Collection
    {
        return $this->responses;
    }

    public function addResponse(Responseform $response): self
    {
        if (!$this->responses->contains($response)) {
            $this->responses[] = $response;
            $response->setIdQuestion($this);
        }

        return $this;
    }

    public function removeResponse(Responseform $response): self
    {
        if ($this->responses->removeElement($response)) {
            // set the owning side to null (unless already changed)
            if ($response->getIdQuestion() === $this) {
                $response->setIdQuestion(null);
            }
        }

        return $this;
    }
}