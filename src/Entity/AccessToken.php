<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @package App\Entity
 * @ORM\Entity()
 * @ORM\Table(name="`access_token`")
 */
class AccessToken
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
    private $userId;
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $clientId;
    /**
     * @var array
     * @ORM\Column(type="json_array")
     */
    private $scopes;
    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $revoked;
    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    private $createdAt;
    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;
    /**
     * @var \DateTimeImmutable
     * @ORM\Column(type="datetime")
     */
    private $expiresAt;

    /**
     * Token constructor.
     * @param string $id
     * @param string $userId
     * @param string $clientId
     * @param array $scopes
     * @param bool $revoked
     * @param \DateTime $createdAt
     * @param \DateTime $updatedAt
     * @param \DateTimeImmutable $expiresAt
     */
    public function __construct(
        string $id,
        string $userId,
        string $clientId,
        array $scopes,
        bool $revoked,
        \DateTime $createdAt,
        \DateTime $updatedAt,
        \DateTimeImmutable $expiresAt
    )
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->clientId = $clientId;
        $this->scopes = $scopes;
        $this->revoked = $revoked;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->expiresAt = $expiresAt;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getClientId(): string
    {
        return $this->clientId;
    }

    /**
     * @return array
     */
    public function getScopes(): array
    {
        return $this->scopes;
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
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt(\DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getExpiresAt(): \DateTimeImmutable
    {
        return $this->expiresAt;
    }
}