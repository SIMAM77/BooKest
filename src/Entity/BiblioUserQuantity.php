<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BiblioUserQuantityRepository")
 */
class BiblioUserQuantity
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
    private $id_biblio;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_user;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_livre;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_genre;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdBiblio(): ?int
    {
        return $this->id_biblio;
    }

    public function setIdBiblio(int $id_biblio): self
    {
        $this->id_biblio = $id_biblio;

        return $this;
    }

    public function getIdUser(): ?int
    {
        return $this->id_user;
    }

    public function setIdUser(int $id_user): self
    {
        $this->id_user = $id_user;

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

    public function getIdGenre(): ?int
    {
        return $this->id_genre;
    }

    public function setIdGenre(int $id_genre): self
    {
        $this->id_genre = $id_genre;

        return $this;
    }
}
