<?php

namespace App\League;

use App\OAuth2\UserRepositoryInterface as AppUserRepositoryInterface;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\UserEntityInterface;
use League\OAuth2\Server\Repositories\UserRepositoryInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

final class UserRepository implements UserRepositoryInterface
{

    /**
     * @var AppUserRepositoryInterface
     */
    private $appUserRepository;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $userPasswordEncoder;

    public function __construct(AppUserRepositoryInterface $appUserRepository, UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->appUserRepository = $appUserRepository;
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    /**
     * {@inheritdoc}
     */
    public function getUserEntityByUserCredentials(
        $username,
        $password,
        $grantType,
        ClientEntityInterface $clientEntity
    ): ?UserEntityInterface
    {

        $appUser = $this->appUserRepository->findOneByEmail($username);
        if ($appUser === null) {
            return null;
        }

        $isPasswordValid = $this->userPasswordEncoder->isPasswordValid($appUser, $password);
        if (!$isPasswordValid) {
            return null;
        }
        $oAuthUser = new User($appUser->getId());
        return $oAuthUser;
    }
}