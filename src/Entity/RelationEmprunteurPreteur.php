<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RelationEmprunteurPreteurRepository")
 */
class RelationEmprunteurPreteur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_emprunteur;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_preteur;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_livre;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_start;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_end;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status_emprunt;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdEmprunteur(): ?int
    {
        return $this->id_emprunteur;
    }

    public function setIdEmprunteur(int $id_emprunteur): self
    {
        $this->id_emprunteur = $id_emprunteur;

        return $this;
    }

    public function getIdPreteur(): ?int
    {
        return $this->id_preteur;
    }

    public function setIdPreteur(int $id_preteur): self
    {
        $this->id_preteur = $id_preteur;

        return $this;
    }

    public function getIdLivre(): ?int
    {
        return $this->id_livre;
    }

    public function setIdLivre(int $id_livre): self
    {
        $this->id_livre = $id_livre;

        return $this;
    }

    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->date_start;
    }

    public function setDateStart(\DateTimeInterface $date_start): self
    {
        $this->date_start = $date_start;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->date_end;
    }

    public function setDateEnd(\DateTimeInterface $date_end): self
    {
        $this->date_end = $date_end;

        return $this;
    }

    public function getStatusEmprunt(): ?string
    {
        return $this->status_emprunt;
    }

    public function setStatusEmprunt(string $status_emprunt): self
    {
        $this->status_emprunt = $status_emprunt;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }
}
