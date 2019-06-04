<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Library", mappedBy="user", cascade={"persist", "remove"})
     */
    private $library;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Rate", mappedBy="user")
     */
    private $rates;

    public function __construct()
    {
        parent::__construct();
        $this->rates = new ArrayCollection();
        // your own logic
    }

    public function getLibrary(): ?Library
    {
        return $this->library;
    }

    public function setLibrary(Library $library): self
    {
        $this->library = $library;

        // set the owning side of the relation if necessary
        if ($this !== $library->getUser()) {
            $library->setUser($this);
        }

        return $this;
    }

    /**
     * @return Collection|Rate[]
     */
    public function getRates(): Collection
    {
        return $this->rates;
    }

    public function addRate(Rate $rate): self
    {
        if (!$this->rates->contains($rate)) {
            $this->rates[] = $rate;
            $rate->setUser($this);
        }

        return $this;
    }

    public function removeRate(Rate $rate): self
    {
        if ($this->rates->contains($rate)) {
            $this->rates->removeElement($rate);
            // set the owning side to null (unless already changed)
            if ($rate->getUser() === $this) {
                $rate->setUser(null);
            }
        }

        return $this;
    }
}