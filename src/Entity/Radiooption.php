<?php

namespace App\Entity;

use App\Repository\RadiooptionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RadiooptionRepository::class)]
class Radiooption
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(name: 'optiontext', length: 255)]
    private ?string $optionText = null;

    #[ORM\ManyToOne(targetEntity: Question::class, inversedBy: 'radiooptions')]
    #[ORM\JoinColumn(name: 'idquestion', nullable: false)]
    private ?Question $idQuestion = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOptionText(): ?string
    {
        return $this->optionText;
    }

    public function setOptionText(string $optionText): self
    {
        $this->optionText = $optionText;

        return $this;
    }

    public function getIdQuestion(): ?Question
    {
        return $this->idQuestion;
    }

    public function setIdQuestion(?Question $idQuestion): self
    {
        $this->idQuestion = $idQuestion;

        return $this;
    }
}