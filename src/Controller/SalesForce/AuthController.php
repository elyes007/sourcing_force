<?php

namespace App\Controller\SalesForce;

use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Router;

class AuthController extends Controller
{
    private $consumerKey = "3MVG9tzQRhEbH_K2RYaOnMx84l6LitWvyrpr8facXGgODL7ql3gZCqcNY1y9.DeW7pyoRhrp9Dkv6ucLvzOr3";
    private $consumerSecret = "A79E505EA3317F2A067DBF8D3125083579F46CE250E0FD10CC29A93A77936AF8";
    private $codeEndPoint = 'https://login.salesforce.com/services/oauth2/authorize';
    private $tokenEndPoint = 'https://login.salesforce.com/services/oauth2/token';

    /**
     * @Route("/auth", name="auth")
     */
    public function auth(Request $req)
    {
        $session = new Session();
        $session->set('action', $req->query->get('action'));

        $client = new Client(['base_uri' => '']);
        $params = [
            'response_type' => 'code',
            'client_id' => $this->consumerKey,
            'redirect_uri' => 'http://localhost/auth_redirect'
        ];

        $response = $client->get(
            $this->codeEndPoint,
            [
                'query' => $params
            ]);

        return new Response($response->getBody()->getContents());
    }

    /**
     * @Route("auth_redirect", name="auth_redirect")
     */
    public function authRedirect(Request $request)
    {
        $code = $request->query->get('code');
        $client = new Client(['base_uri' => '']);

        $response = $client->request('POST', $this->tokenEndPoint,
            [
                'form_params' => [
                    'grant_type' => 'authorization_code',
                    'redirect_uri' => 'http://localhost/auth_redirect',
                    'code' => $code,
                    'client_id' => $this->consumerKey,
                    'client_secret' => $this->consumerSecret
                ]
            ]
        );

        $json = json_decode($response->getBody()->getContents(), true);


        $session = new Session();
        $session->set('token', $json['access_token']);

        /** @var Router $router */
        $router = $this->get('router');
        if ($router->getRouteCollection()->get($session->get('action')) == null) {
            return $this->redirect($session->get('action') . '?token=' . $session->get('token'));
        } else {
            return $this->redirectToRoute($session->get('action'));
        }
    }
}
