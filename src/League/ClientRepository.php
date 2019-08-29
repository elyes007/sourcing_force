<?php

namespace App\League;

use App\OAuth2\ClientRepositoryInterface as AppClientRepositoryInterface;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Repositories\ClientRepositoryInterface;

final class ClientRepository implements ClientRepositoryInterface
{
    /**
     * @var AppClientRepositoryInterface
     */
    private $appClientRepository;

    /**
     * ClientRepository constructor.
     * @param AppClientRepositoryInterface $clientRepository
     */
    public function __construct(AppClientRepositoryInterface $appClientRepository)
    {
        $this->appClientRepository = $appClientRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function getClientEntity(
        $clientIdentifier
    ): ?ClientEntityInterface
    {
        $appClient = $this->appClientRepository->findActive($clientIdentifier);
        if ($appClient === null) {
            return null;
        }

        $oauthClient = new Client($clientIdentifier, $appClient->getName(), $appClient->getRedirect());
        return $oauthClient;
    }

    /**
     * Validate a client's secret.
     *
     * @param string $clientIdentifier The client's identifier
     * @param null|string $clientSecret The client's secret (if sent)
     * @param null|string $grantType The type of grant the client is using (if sent)
     *
     * @return bool
     */
    public function validateClient($clientIdentifier, $clientSecret, $grantType)
    {
        $appClient = $this->appClientRepository->findActive($clientIdentifier);
        if ($appClient === null) {
            return false;
        }
        return hash_equals($appClient->getSecret(), (string)$clientSecret);
    }
}