<?php

namespace App\Controller\SalesForce;

use App\Entity\Contract;
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

class ContractController extends AbstractController
{
    const BASE_URL = "https://um5.salesforce.com";
    const QUERY_URL = self::BASE_URL . "/services/data/v20.0/query/";
    const SESSION_CONTRACT_ID = 'contract_id';
    const SESSION_CONTRACT_PARAMS = 'contract_params';

    /**
     * @Route("api/salesforce/create_contract", name="salesforce_create_contract", methods={"POST"})
     */
    public function create(Request $req)
    {
        $session = new Session();
        $token = $session->get('token') == null ? $req->query->get('token') : $session->get('token');

        $body = json_decode($req->getContent(), true);

        if (count($body) > 0) {
            $session->set(self::SESSION_CONTRACT_PARAMS, $body);
        }

        if ($token == null) {
            return $this->redirectToRoute('auth', ['action' => 'salesforce_create_contract']);
        }

        $client = new Client(['base_uri' => '']);
        try {
            $response = $client->request(
                'POST',
                self::BASE_URL . '/services/data/v39.0/sobjects/Contract',
                [
                    'json' => $session->get(self::SESSION_CONTRACT_PARAMS),
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
     * @Route("api/salesforce/find_contract", name="salesforce_find_contract")
     */
    public function find(Request $req)
    {
        $session = new Session();
        $token = $session->get('token') == null ? $req->query->get('token') : $session->get('token');

        if ($req->query->has('id')) {
            $session->set(self::SESSION_CONTRACT_ID, $req->query->get('id'));
        }

        if ($token == null) {
            return $this->redirectToRoute('auth', ['action' => 'salesforce_find_contract']);
        }

        $client = new Client(['base_uri' => '']);
        try {
            $response = $client->request(
                'GET',
                self::BASE_URL . '/services/data/v39.0/sobjects/Contract/' . $session->get(self::SESSION_CONTRACT_ID),
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
     * @Route("api/salesforce/delete_contract", name="salesforce_delete_contract", methods={"DELETE"})
     */
    public function delete(Request $req)
    {
        $session = new Session();
        $token = $session->get('token') == null ? $req->query->get('token') : $session->get('token');

        if ($req->query->has('id')) {
            $session->set(self::SESSION_CONTRACT_ID, $req->query->get('id'));
        }

        if ($token == null) {
            return $this->redirectToRoute('auth', ['action' => 'salesforce_delete_contract']);
        }

        $client = new Client(['base_uri' => '']);
        try {
            $response = $client->request(
                'DELETE',
                self::BASE_URL . '/services/data/v39.0/sobjects/Contract/' . $session->get(self::SESSION_CONTRACT_ID),
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
     * @Route("api/salesforce/update_contract", name="salesforce_update_contract", methods={"PUT"})
     */
    public function update(Request $req)
    {
        $session = new Session();
        $token = $session->get('token') == null ? $req->query->get('token') : $session->get('token');

        $body = json_decode($req->getContent(), true);

        if (count($body) > 0) {
            $session->set(self::SESSION_CONTRACT_PARAMS, $body);
            $session->set(self::SESSION_CONTRACT_ID, $req->query->get('id'));
        }

        if ($token == null) {
            return $this->redirectToRoute('auth', ['action' => 'salesforce_update_contract']);
        }

        $client = new Client(['base_uri' => '']);
        try {
            $response = $client->request(
                'PATCH',
                self::BASE_URL . '/services/data/v39.0/sobjects/Contract/' . $session->get(self::SESSION_CONTRACT_ID),
                [
                    'json' => $session->get(self::SESSION_CONTRACT_PARAMS),
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
     * @Route("api/salesforce/find_all_contracts", name="salesforce_find_all_contracts")
     */
    public function findAll(Request $req)
    {
        $session = new Session();
        $token = $session->get('token') == null ? $req->query->get('token') : $session->get('token');

        if ($token == null) {
            return $this->redirectToRoute('auth', ['action' => 'salesforce_find_all_contracts']);
        }

        $client = new Client(['base_uri' => '']);
        try {
            $response = $client->request(
                'GET',
                self::QUERY_URL,
                [
                    'query' => ['q' => 'SELECT id FROM Contract'],
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
     * @Route("api/migration/contract_to_salesforce", name="migrate_contract_to_salesforce")
     */
    public function migrateContractToSalesForce(Request $req)
    {

        $contract = $this->getDoctrine()->getRepository(Contract::class)->find($req->query->get('id'));

        $contract = $this->dismount($contract);
        unset($contract['uid']);

        $client = new Client(['base_uri' => '']);
        try {
            $response = $client->request(
                'POST',
                self::BASE_URL . '/services/data/v39.0/sobjects/Contract',
                [
                    'json' => $contract,
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
     * @Route("api/migration/contract_to_sourcingforce", name="migrate_contract_to_sourcingforce")
     */
    public function migrateContractToSourcingForce(Request $req)
    {
        $client = new Client(['base_uri' => '']);
        try {
            $response = $client->request(
                'GET',
                self::BASE_URL . '/services/data/v39.0/sobjects/Contract/' . $req->query->get('id'),
                [
                    'headers' => ['Authorization' => 'Bearer ' . $req->query->get('token')]
                ]
            );
            $contract = json_decode($response->getBody()->getContents(), true);
            foreach ($contract as $key => $value) {
                if ($value == null) {
                    unset($contract[$key]);
                }
            }

            $serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
            $contract = $serializer->denormalize($contract, 'App\Entity\Contract');

            $this->getDoctrine()->getManager()->persist($contract);
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