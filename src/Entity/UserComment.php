<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserComment
 *
 * @ORM\Table(name="user_comment")
 * @ORM\Entity
 */
class UserComment
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
     * @var int
     *
     * @ORM\Column(name="receiver_id", type="integer", nullable=false)
     */
    private $receiverId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="sender_id", type="integer", nullable=true)
     */
    private $senderId;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", length=65535, nullable=false)
     */
    private $content;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;


}
