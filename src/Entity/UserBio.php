<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserBio
 *
 * @ORM\Table(name="user_bio")
 * @ORM\Entity
 */
class UserBio
{
    /**
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $userId;

    /**
     * @var int
     *
     * @ORM\Column(name="avatar_id", type="integer", nullable=false)
     */
    private $avatarId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="biography", type="text", length=65535, nullable=true)
     */
    private $biography;

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function getAvatarId(): ?int
    {
        return $this->avatarId;
    }

    public function setAvatarId(int $avatarId): self
    {
        $this->avatarId = $avatarId;

        return $this;
    }

    public function getBiography(): ?string
    {
        return $this->biography;
    }

    public function setBiography(?string $biography): self
    {
        $this->biography = $biography;

        return $this;
    }


}
