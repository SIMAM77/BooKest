<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BookCategory
 *
 * @ORM\Table(name="book_category")
 * @ORM\Entity
 */
class BookCategory
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
     * @var string|null
     *
     * @ORM\Column(name="category", type="string", length=255, nullable=true)
     */
    private $category;


}
