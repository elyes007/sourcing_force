<?php

use function OpenApi\scan;

require("vendor/autoload.php");
$openapi = scan('src');
header('Content-Type: application/x-yaml');
echo $openapi->toYaml();
