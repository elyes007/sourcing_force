<?php

namespace App\Controller;

use League\OAuth2\Server\AuthorizationServer;
use League\OAuth2\Server\Exception\OAuthServerException;
use League\OAuth2\Server\Grant\PasswordGrant;
use Nyholm\Psr7\Factory\Psr17Factory;
use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Zend\Diactoros\Response as Psr7Response;

final class OAuthController
{
    /**
     * @var AuthorizationServer
     */
    private $authorizationServer;
    /**
     * @var PasswordGrant
     */
    private $passwordGrant;

    /**
     * AuthController constructor.
     * @param AuthorizationServer $authorizationServer
     * @param PasswordGrant $passwordGrant
     */
    public function __construct(
        AuthorizationServer $authorizationServer,
        PasswordGrant $passwordGrant
    )
    {
        $this->authorizationServer = $authorizationServer;
        $this->passwordGrant = $passwordGrant;
    }

    /**
     * @Route("api/accessToken", name="api_get_access_token", methods={"POST"})
     */
    public function getAccessToken(Request $symRequest)
    {
        $psr17Factory = new Psr17Factory();
        $psrHttpFactory = new PsrHttpFactory($psr17Factory, $psr17Factory, $psr17Factory, $psr17Factory);
        $request = $psrHttpFactory->createRequest($symRequest);

        $this->passwordGrant->setRefreshTokenTTL(new \DateInterval('P1M'));
        $response = $this->withErrorHandling(function () use ($request) {
            $this->passwordGrant->setRefreshTokenTTL(new \DateInterval('P1M'));
            $this->authorizationServer->enableGrantType(
                $this->passwordGrant,
                new \DateInterval('P1D')
            );
            return $this->authorizationServer->respondToAccessTokenRequest($request, new Psr7Response());
        });

        $httpFoundationFactory = new HttpFoundationFactory();
        $symfonyResponse = $httpFoundationFactory->createResponse($response);

        return $symfonyResponse;
    }

    private function withErrorHandling($callback): ?Psr7Response
    {
        try {
            return $callback();
        } catch (OAuthServerException $e) {
            echo $e->getMessage();
            return $this->convertResponse(
                $e->generateHttpResponse(new Psr7Response())
            );
        } catch (\Exception $e) {
            echo $e->getMessage();
            return new Psr7Response($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (\Throwable $e) {
            echo $e->getMessage();
            return new Psr7Response($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function convertResponse(Psr7Response $psrResponse): Psr7Response
    {
        return new Psr7Response(
            $psrResponse->getBody(),
            $psrResponse->getStatusCode(),
            $psrResponse->getHeaders()
        );
    }
}