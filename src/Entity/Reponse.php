<?php

namespace App\Entity;

use App\Repository\ReponseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReponseRepository::class)]
class Reponse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Form::class, inversedBy: 'responses')]
    #[ORM\JoinColumn(name: 'idform',nullable: false)]
    private ?Form $idForm = null;

    #[ORM\Column(name: 'datereponse', type: 'datetime')]
    private ?\DateTimeInterface $dateResponse = null;

    #[ORM\OneToMany(targetEntity: Reponsequestion::class, mappedBy: 'idReponse', cascade: ['persist'], orphanRemoval: true)]
    private Collection $reponsequestions;

    public function __construct()
    {
        $this->reponsequestions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDateResponse(): ?\DateTimeInterface
    {
        return $this->dateResponse;
    }

    public function setDateResponse(\DateTimeInterface $dateResponse): self
    {
        $this->dateResponse = $dateResponse;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getReponsequestions(): Collection
    {
        return $this->reponsequestions;
    }

    public function addReponsequestion(Reponsequestion $reponsequestion): self
    {
        if (!$this->reponsequestions->contains($reponsequestion)) {
            $this->reponsequestions[] = $reponsequestion;
            $reponsequestion->setIdReponse($this);
        }

        return $this;
    }

    public function removeReponsequestion(Reponsequestion $reponsequestion): self
    {
        if ($this->reponsequestions->removeElement($reponsequestion)) {
            // set the owning side to null (unless already changed)
            if ($reponsequestion->getIdReponse() === $this) {
                $reponsequestion->setIdReponse(null);
            }
        }

        return $this;
    }
}