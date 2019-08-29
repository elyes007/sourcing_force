<?php

namespace App\OAuth2;

use App\Entity\RefreshToken;

interface RefreshTokenRepositoryInterface
{
    public function find(string $refreshTokenId): ?RefreshToken;

    public function save(RefreshToken $refreshToken): void;
}