<?php

namespace App\Controller\SalesForce;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    const BASE_URL = "https://um5.salesforce.com";
    const QUERY_URL = self::BASE_URL . "/services/data/v20.0/query/";
    const SESSION_ORDER_ID = 'order_id';
    const SESSION_ORDER_PARAMS = 'order_params';

    /**
     * @Route("api/salesforce/create_order", name="salesforce_create_order", methods={"POST"})
     */
    public function create(Request $req)
    {
        $session = new Session();
        $token = $session->get('token') == null ? $req->query->get('token') : $session->get('token');

        $body = json_decode($req->getContent(), true);

        if (count($body) > 0) {
            $session->set(self::SESSION_ORDER_PARAMS, $body);
        }

        if ($token == null) {
            return $this->redirectToRoute('auth', ['action' => 'salesforce_create_order']);
        }

        $client = new Client(['base_uri' => '']);
        try {
            $response = $client->request(
                'POST',
                self::BASE_URL . '/services/data/v39.0/sobjects/Order',
                [
                    'json' => $session->get(self::SESSION_ORDER_PARAMS),
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
     * @Route("api/salesforce/find_order", name="salesforce_find_order")
     */
    public function find(Request $req)
    {
        $session = new Session();
        $token = $session->get('token') == null ? $req->query->get('token') : $session->get('token');

        if ($req->query->has('id')) {
            $session->set(self::SESSION_ORDER_ID, $req->query->get('id'));
        }

        if ($token == null) {
            return $this->redirectToRoute('auth', ['action' => 'salesforce_find_order']);
        }

        $client = new Client(['base_uri' => '']);
        try {
            $response = $client->request(
                'GET',
                self::BASE_URL . '/services/data/v39.0/sobjects/Order/' . $session->get(self::SESSION_ORDER_ID),
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
     * @Route("api/salesforce/delete_order", name="salesforce_delete_order", methods={"DELETE"})
     */
    public function delete(Request $req)
    {
        $session = new Session();
        $token = $session->get('token') == null ? $req->query->get('token') : $session->get('token');

        if ($req->query->has('id')) {
            $session->set(self::SESSION_ORDER_ID, $req->query->get('id'));
        }

        if ($token == null) {
            return $this->redirectToRoute('auth', ['action' => 'salesforce_delete_order']);
        }

        $client = new Client(['base_uri' => '']);
        try {
            $response = $client->request(
                'DELETE',
                self::BASE_URL . '/services/data/v39.0/sobjects/Order/' . $session->get(self::SESSION_ORDER_ID),
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
     * @Route("api/salesforce/update_order", name="salesforce_update_order", methods={"PUT"})
     */
    public function update(Request $req)
    {
        $session = new Session();
        $token = $session->get('token') == null ? $req->query->get('token') : $session->get('token');

        $body = json_decode($req->getContent(), true);

        if (count($body) > 0) {
            $session->set(self::SESSION_ORDER_PARAMS, $body);
            $session->set(self::SESSION_ORDER_ID, $req->query->get('id'));
        }

        if ($token == null) {
            return $this->redirectToRoute('auth', ['action' => 'salesforce_update_order']);
        }

        $client = new Client(['base_uri' => '']);
        try {
            $response = $client->request(
                'PATCH',
                self::BASE_URL . '/services/data/v39.0/sobjects/Order/' . $session->get(self::SESSION_ORDER_ID),
                [
                    'json' => $session->get(self::SESSION_ORDER_PARAMS),
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
     * @Route("api/salesforce/find_all_orders", name="salesforce_find_all_orders")
     */
    public function findAll(Request $req)
    {
        $session = new Session();
        $token = $session->get('token') == null ? $req->query->get('token') : $session->get('token');

        if ($token == null) {
            return $this->redirectToRoute('auth', ['action' => 'salesforce_find_all_orders']);
        }

        $client = new Client(['base_uri' => '']);
        try {
            $response = $client->request(
                'GET',
                self::QUERY_URL,
                [
                    'query' => ['q' => 'SELECT id FROM Order'],
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
}