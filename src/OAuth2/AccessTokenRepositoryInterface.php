<?php

namespace App\OAuth2;

use App\Entity\AccessToken;

interface AccessTokenRepositoryInterface
{
    public function find(string $accessTokenId): ?AccessToken;

    public function save(AccessToken $accessToken): void;
}