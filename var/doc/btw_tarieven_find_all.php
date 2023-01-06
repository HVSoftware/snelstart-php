<?php

use SnelstartPHP\Connector\BtwTariefConnector;
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

$btwTariefConnector = new BtwTariefConnector($connection);

foreach ($btwTariefConnector->findAll() as $btwTarief) {
    echo vsprintf("soort=%s percentage=%s datum_vanaf=%s tot_en_met=%s\n", [
        $btwTarief->getBtwSoort()->getValue(),
        $btwTarief->getBtwPercentage(),
        $btwTarief->getDatumVanaf()->format('Y-m-d'),
        $btwTarief->getDatumTotEnMet()->format('Y-m-d'),
    ]);
}
