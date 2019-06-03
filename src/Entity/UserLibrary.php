<?php

namespace App\Entity;

use App\Entity\Book;
use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * UserLibrary
 *
 * @ORM\Table(name="user_library_relation")
 * @ORM\Entity
 */
class UserLibrary
{

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="UserLibrary")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="Book", inversedBy="UserLibrary")
     * @ORM\JoinColumn(name="book_id", referencedColumnName="id", nullable=false)
     */
    protected $library;

    /**
     * @var string|null
     *
     * @ORM\Column(name="status", type="string", nullable=true)
     */
    protected $status;

    public function __construct()
    {
        $this->library = new \Doctrine\Common\Collections\ArrayCollection();
        // your own logic
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get books
     *
     * @return UserLibrary
     */
    public function getLibrary()
    {
        return $this->library;
    }

    /**
     * Add book
     *
     * @param \App\Entity\Book $oBook
     * @return Book
     */
    public function addBook(\App\Entity\Book $oBook)
    {
        $this->library[] = $oBook;

        return $this;
    }

    /**
     * Remove book
     *
     * @param \App\Entity\Book $oBook
     */
    public function removeBook(\App\Entity\Book $oBook)
    {
        $this->library->removeElement($oBook);
    }
}
