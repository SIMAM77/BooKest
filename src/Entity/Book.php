<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Book
 *
 * @ORM\Table(name="book")
 * @ORM\Entity
 */
class Book
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false, options={"default"="Titre inconnu"})
     */
    private $title = 'Titre inconnu';

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255, nullable=false, options={"default"="Auteur inconnu"})
     */
    private $author = 'Auteur inconnu';

    /**
     * @var string|null
     *
     * @ORM\Column(name="synopsis", type="text", length=0, nullable=true)
     */
    private $synopsis;

    /**
     * @var int
     *
     * @ORM\Column(name="category", type="integer", nullable=false, options={"default"="1"})
     */
    private $category = '1';

    /**
     * @var int
     *
     * @ORM\Column(name="isbn", type="bigint", nullable=false)
     */
    private $isbn;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;


}
