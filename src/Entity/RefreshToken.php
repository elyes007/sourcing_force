<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @package App\Entity
 * @ORM\Entity()
 * @ORM\Table(name="`refresh_token`")
 */
class RefreshToken
{
    /**
     * @var string
     * @ORM\Id()
     * @ORM\Column(type="string")
     */
    private $id;
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $accessTokenId;
    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $revoked = false;
    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    private $expiresAt;

    /**
     * RefreshToken constructor.
     * @param string $id
     * @param string $accessTokenId
     * @param \DateTimeImmutable $expiresAt
     */
    public function __construct(string $id, string $accessTokenId, \DateTimeImmutable $expiresAt)
    {
        $this->id = $id;
        $this->accessTokenId = $accessTokenId;
        $this->expiresAt = $expiresAt;
    }

    /**
     * @return string
     */
    public function getAccessTokenId(): string
    {
        return $this->accessTokenId;
    }

    /**
     * @return bool
     */
    public function isRevoked(): bool
    {
        return $this->revoked;
    }

    public function revoke(): void
    {
        $this->revoked = true;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getExpiresAt(): \DateTimeImmutable
    {
        return $this->expiresAt;
    }
}