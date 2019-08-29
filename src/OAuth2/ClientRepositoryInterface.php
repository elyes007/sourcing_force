<?php

namespace App\OAuth2;

use App\Entity\Client;

interface ClientRepositoryInterface
{
    public function findActive(string $clientId): ?Client;
}