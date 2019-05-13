<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserRate
 *
 * @ORM\Table(name="user_rate")
 * @ORM\Entity
 */
class UserRate
{
    /**
     * @var int
     *
     * @ORM\Column(name="receiver_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $receiverId;

    /**
     * @var int
     *
     * @ORM\Column(name="sender_id", type="integer", nullable=false)
     */
    private $senderId;

    /**
     * @var int
     *
     * @ORM\Column(name="rate", type="integer", nullable=false)
     */
    private $rate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;


}
