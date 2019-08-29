<?php

namespace App\Controller\SalesForce;

use App\Controller\TokenAuthenticatedController;
use App\Entity\Order;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use ReflectionClass;
use ReflectionException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class OrderController extends AbstractController implements TokenAuthenticatedController
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

    /**
     * @Route("api/migration/order_to_salesforce", name="migrate_order_to_salesforce")
     */
    public function migrateOrderToSalesForce(Request $req)
    {

        $order = $this->getDoctrine()->getRepository(Order::class)->find($req->query->get('id'));

        $order = $this->dismount($order);
        unset($order['uid']);
        unset($order['StatusCode']);

        $client = new Client(['base_uri' => '']);
        try {
            $response = $client->request(
                'POST',
                self::BASE_URL . '/services/data/v39.0/sobjects/Order',
                [
                    'json' => $order,
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
     * @Route("api/migration/order_to_sourcingforce", name="migrate_order_to_sourcingforce")
     */
    public function migrateOrderToSourcingForce(Request $req)
    {
        $client = new Client(['base_uri' => '']);
        try {
            $response = $client->request(
                'GET',
                self::BASE_URL . '/services/data/v39.0/sobjects/Order/' . $req->query->get('id'),
                [
                    'headers' => ['Authorization' => 'Bearer ' . $req->query->get('token')]
                ]
            );
            $order = json_decode($response->getBody()->getContents(), true);
            foreach ($order as $key => $value) {
                if ($value == null) {
                    unset($order[$key]);
                }
            }

            $serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
            $order = $serializer->denormalize($order, 'App\Entity\Order');

            //var_dump($order);

            $this->getDoctrine()->getManager()->persist($order);
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