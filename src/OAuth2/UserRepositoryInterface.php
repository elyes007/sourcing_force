<?php

namespace App\OAuth2;

use App\Entity\User;

interface UserRepositoryInterface
{
    public function find(string $id): ?User;

    public function findOneByEmail(string $username): ?User;

    public function save(User $user): void;

    public function remove(User $user): void;
}
