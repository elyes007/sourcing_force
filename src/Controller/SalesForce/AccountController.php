<?php

namespace App\Controller\SalesForce;

use App\Controller\TokenAuthenticatedController;
use App\Entity\Account;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use ReflectionClass;
use ReflectionException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class AccountController extends Controller implements TokenAuthenticatedController
{
    const BASE_URL = "https://um5.salesforce.com";
    const QUERY_URL = self::BASE_URL . "/services/data/v20.0/query/";
    const SESSION_ACCOUNT_ID = 'account_id';
    const SESSION_ACCOUNT_PARAMS = 'account_params';

    /**
     * @Route("api/salesforce/create_account", name="salesforce_create_account", methods={"POST"})
     */
    public function create(Request $req)
    {
        $session = new Session();
        $token = $session->get('token') == null ? $req->query->get('token') : $session->get('token');

        $body = json_decode($req->getContent(), true);

        if (count($body) > 0) {
            $session->set(self::SESSION_ACCOUNT_PARAMS, $body);
        }

        if ($token == null) {
            return $this->redirectToRoute('auth', ['action' => 'salesforce_create_account']);
        }

        $client = new Client(['base_uri' => '']);
        try {
            $response = $client->request(
                'POST',
                self::BASE_URL . '/services/data/v39.0/sobjects/Account',
                [
                    'json' => $session->get(self::SESSION_ACCOUNT_PARAMS),
                    'headers' => ['Authorization' => 'Bearer ' . $token]
                ]
            );
            return JsonResponse::fromJsonString($response->getBody()->getContents());
        } catch (GuzzleException $e) {
            $error = ["errorCode" => $e->getCode(), "message" => $e->getMessage()];
            return JsonResponse::fromJsonString(json_encode($error), $e->getCode());
        }
    }

    /**
     * @Route("api/salesforce/find_account", name="salesforce_find_account")
     */
    public function find(Request $req)
    {
        $session = new Session();
        $token = $session->get('token') == null ? $req->query->get('token') : $session->get('token');

        if ($req->query->has('id')) {
            $session->set(self::SESSION_ACCOUNT_ID, $req->query->get('id'));
        }

        if ($token == null) {
            return $this->redirectToRoute('auth', ['action' => 'salesforce_find_account']);
        }

        $client = new Client(['base_uri' => '']);
        try {
            $response = $client->request(
                'GET',
                self::BASE_URL . '/services/data/v39.0/sobjects/Account/' . $session->get(self::SESSION_ACCOUNT_ID),
                [
                    'headers' => ['Authorization' => 'Bearer ' . $token]
                ]
            );
            return JsonResponse::fromJsonString($response->getBody()->getContents());
        } catch (GuzzleException $e) {
            $error = ["errorCode" => $e->getCode(), "message" => $e->getMessage()];
            return JsonResponse::fromJsonString(json_encode($error), $e->getCode());
        }
    }

    /**
     * @Route("api/salesforce/delete_account", name="salesforce_delete_account", methods={"DELETE"})
     */
    public function delete(Request $req)
    {
        $session = new Session();
        $token = $session->get('token') == null ? $req->query->get('token') : $session->get('token');

        if ($req->query->has('id')) {
            $session->set(self::SESSION_ACCOUNT_ID, $req->query->get('id'));
        }

        if ($token == null) {
            return $this->redirectToRoute('auth', ['action' => 'salesforce_delete_account']);
        }

        $client = new Client(['base_uri' => '']);
        try {
            $response = $client->request(
                'DELETE',
                self::BASE_URL . '/services/data/v39.0/sobjects/Account/' . $session->get(self::SESSION_ACCOUNT_ID),
                [
                    'headers' => ['Authorization' => 'Bearer ' . $token]
                ]
            );
            return JsonResponse::fromJsonString($response->getBody()->getContents());
        } catch (GuzzleException $e) {
            $error = ["errorCode" => $e->getCode(), "message" => $e->getMessage()];
            return JsonResponse::fromJsonString(json_encode($error), $e->getCode());
        }
    }

    /**
     * @Route("api/salesforce/update_account", name="salesforce_update_account", methods={"PUT"})
     */
    public function update(Request $req)
    {
        $session = new Session();
        $token = $session->get('token') == null ? $req->query->get('token') : $session->get('token');

        $body = json_decode($req->getContent(), true);

        if (count($body) > 0) {
            $session->set(self::SESSION_ACCOUNT_PARAMS, $body);
            $session->set(self::SESSION_ACCOUNT_ID, $req->query->get('id'));
        }

        if ($token == null) {
            return $this->redirectToRoute('auth', ['action' => 'salesforce_update_account']);
        }

        $client = new Client(['base_uri' => '']);
        try {
            $response = $client->request(
                'PATCH',
                self::BASE_URL . '/services/data/v39.0/sobjects/Account/' . $session->get(self::SESSION_ACCOUNT_ID),
                [
                    'json' => $session->get(self::SESSION_ACCOUNT_PARAMS),
                    'headers' => ['Authorization' => 'Bearer ' . $token]
                ]
            );
            return JsonResponse::fromJsonString($response->getBody()->getContents());
        } catch (GuzzleException $e) {
            $error = ["errorCode" => $e->getCode(), "message" => $e->getMessage()];
            return JsonResponse::fromJsonString(json_encode($error), $e->getCode());
        }
    }

    /**
     * @Route("api/salesforce/find_all_accounts", name="salesforce_find_all_accounts")
     */
    public function findAll(Request $req)
    {
        $session = new Session();
        $token = $session->get('token') == null ? $req->query->get('token') : $session->get('token');

        if ($token == null) {
            return $this->redirectToRoute('auth', ['action' => 'salesforce_find_all_accounts']);
        }

        $client = new Client(['base_uri' => '']);
        try {
            $response = $client->request(
                'GET',
                self::QUERY_URL,
                [
                    'query' => ['q' => 'SELECT name, id FROM Account'],
                    'headers' => ['Authorization' => 'Bearer ' . $token]
                ]
            );
            $body = json_decode($response->getBody()->getContents(), true);
            $data = $body['records'];
            return new JsonResponse($data);
        } catch (GuzzleException $e) {
            $error = ["errorCode" => $e->getCode(), "message" => $e->getMessage()];
            return JsonResponse::fromJsonString(json_encode($error), $e->getCode());
        }
    }

    /**
     * @Route("api/migration/account_to_salesforce", name="migrate_account_to_salesforce")
     */
    public function migrateAccountToSalesForce(Request $req)
    {

        $account = $this->getDoctrine()->getRepository(Account::class)->find($req->query->get('id'));

        $account = $this->dismount($account);
        unset($account['uid']);

        $client = new Client(['base_uri' => '']);
        try {
            $response = $client->request(
                'POST',
                self::BASE_URL . '/services/data/v39.0/sobjects/Account',
                [
                    'json' => $account,
                    'headers' => ['Authorization' => 'Bearer ' . $req->query->get('token')]
                ]
            );
            return JsonResponse::fromJsonString($response->getBody()->getContents());
        } catch (GuzzleException $e) {
            $error = ["errorCode" => $e->getCode(), "message" => $e->getMessage()];
            return JsonResponse::fromJsonString(json_encode($error), $e->getCode());
        }
    }

    /**
     * @Route("api/migration/account_to_sourcingforce", name="migrate_account_to_sourcingforce")
     */
    public function migrateAccountToSourcingForce(Request $req)
    {
        $client = new Client(['base_uri' => '']);
        try {
            $response = $client->request(
                'GET',
                self::BASE_URL . '/services/data/v39.0/sobjects/Account/' . $req->query->get('id'),
                [
                    'headers' => ['Authorization' => 'Bearer ' . $req->query->get('token')]
                ]
            );
            $account = json_decode($response->getBody()->getContents(), true);
            foreach ($account as $key => $value) {
                if ($value == null) {
                    unset($account[$key]);
                }
            }

            $serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
            $account = $serializer->denormalize($account, 'App\Entity\Account');

            $this->getDoctrine()->getManager()->persist($account);
            $this->getDoctrine()->getManager()->flush();

            return new Response("Success", Response::HTTP_CREATED);
        } catch (GuzzleException $e) {
            $error = ["errorCode" => $e->getCode(), "message" => $e->getMessage()];
            return JsonResponse::fromJsonString(json_encode($error), $e->getCode());
        }
    }

    function dismount($object)
    {
        try {
            $reflectionClass = new ReflectionClass(get_class($object));
            $array = array();
            foreach ($reflectionClass->getProperties() as $property) {
                $property->setAccessible(true);
                if ($property->getValue($object) != null) {
                    $array[$property->getName()] = $property->getValue($object);
                    $property->setAccessible(false);
                }
            }
            return $array;
        } catch (ReflectionException $e) {
            return array();
        }
    }
}