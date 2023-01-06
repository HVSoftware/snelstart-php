<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

use SnelstartPHP\Connector\BoekingConnector;
use SnelstartPHP\Secure\AccessTokenConnection;
use SnelstartPHP\Secure\ApiSubscriptionKey;
use SnelstartPHP\Secure\BearerToken\ClientKeyBearerToken;
use SnelstartPHP\Secure\V2Connector;

require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/config.php';

global $clientKey;
global $primaryKey;
global $secondaryKey;

$bearerToken = new ClientKeyBearerToken($clientKey);
$accessTokenConnection = new AccessTokenConnection($bearerToken);
$accessToken = $accessTokenConnection->getToken();

$connection = new V2Connector(
    new ApiSubscriptionKey($primaryKey, $secondaryKey),
    $accessToken
);

$boekingConnector = new BoekingConnector($connection);

foreach ($boekingConnector->findInkoopfacturen(null, true) as $inkoopboeking) {
    var_dump($inkoopboeking);
}