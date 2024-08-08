<?php

namespace App\Entity;

use App\Repository\ReponsequestionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReponsequestionRepository::class)]
class Reponsequestion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Question::class, inversedBy: 'reponsequestions')]
    #[ORM\JoinColumn(name: 'idquestion', nullable: false)]
    private ?Question $idQuestion = null;

    #[ORM\ManyToOne(targetEntity: Reponse::class, inversedBy: 'reponsequestions')]
    #[ORM\JoinColumn(name: 'idreponse', nullable: false)]
    private ?Reponse $idReponse = null;

    #[ORM\Column(name: 'reponsetext', type: 'string', length: 255)]
    private ?string $reponseText = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIdReponse(): ?Reponse
    {
        return $this->idReponse;
    }

    public function setIdReponse(?Reponse $idReponse): self
    {
        $this->idReponse = $idReponse;

        return $this;
    }

    public function getReponseText(): ?string
    {
        return $this->reponseText;
    }

    public function setReponseText(string $reponseText): self
    {
        $this->reponseText = $reponseText;

        return $this;
    }
}