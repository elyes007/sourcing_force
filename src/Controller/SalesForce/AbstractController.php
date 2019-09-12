<?php


namespace App\Controller\SalesForce;


class AbstractController
{
    const BASE_URL = "https://um5.salesforce.com";
    const QUERY_URL = self::BASE_URL . "/services/data/v20.0/query/";
}