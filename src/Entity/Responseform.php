<?php

namespace App\Entity;

use App\Repository\ResponseformRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResponseformRepository::class)]
class Responseform
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(name: 'sessionid', type: 'string', length: 255)]
    private ?string $sessionId = null;

    #[ORM\Column(type: 'text')]
    private ?string $reponse = null;

    #[ORM\Column(name: 'dateresponse', type: 'datetime')]
    private ?\DateTimeInterface $dateResponse = null;

    #[ORM\ManyToOne(targetEntity: Question::class)]
    #[ORM\JoinColumn(name: 'idquestion', nullable: false)]
    private ?Question $idQuestion = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSessionId(): ?string
    {
        return $this->sessionId;
    }

    public function setSessionId(string $sessionId): self
    {
        $this->sessionId = $sessionId;

        return $this;
    }

    public function getReponse(): ?string
    {
        return $this->reponse;
    }

    public function setReponse(string $reponse): self
    {
        $this->reponse = $reponse;

        return $this;
    }

    public function getDateResponse(): ?\DateTimeInterface
    {
        return $this->dateResponse;
    }

    public function setDateResponse(\DateTimeInterface $dateResponse): self
    {
        $this->dateResponse = $dateResponse;

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