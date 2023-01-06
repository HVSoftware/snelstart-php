<?php

use SnelstartPHP\Connector\ArtikelConnector;
use SnelstartPHP\Connector\RelatieConnector;
use SnelstartPHP\Connector\VerkooporderConnector;
use SnelstartPHP\Model\Type\ProcesStatus;
use SnelstartPHP\Model\Type\VerkooporderBtwIngave;
use SnelstartPHP\Model\Verkooporder;
use SnelstartPHP\Model\VerkooporderRegel;
use SnelstartPHP\Request\ODataRequestData;
use SnelstartPHP\Secure\AccessTokenConnection;
use SnelstartPHP\Secure\ApiSubscriptionKey;
use SnelstartPHP\Secure\BearerToken\ClientKeyBearerToken;
use SnelstartPHP\Secure\V2Connector;

require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/config.php';

global $clientKey;
global $primaryKey;
global $secondaryKey;

// Prerequisites
// Relation with id 2
// Article with code 308

$bearerToken = new ClientKeyBearerToken($clientKey);
$accessTokenConnection = new AccessTokenConnection($bearerToken);
$accessToken = $accessTokenConnection->getToken();

$connection = new V2Connector(
    new ApiSubscriptionKey($primaryKey, $secondaryKey),
    $accessToken
);

$klantConnector = new RelatieConnector($connection);
$searchFilter = (new ODataRequestData())->setFilter([
    sprintf('Relatiecode eq %s', 2)
]);
$klant = $klantConnector->findAllKlanten($searchFilter, true)->current();
$artikelConnector = new ArtikelConnector($connection);
$requestData = new ODataRequestData();
$requestData->setFilter([ "Artikelcode eq '308'" ]);
$requestData->setTop(25);
$artikelen = $artikelConnector->findAll($requestData, true, null, $klant);
$verkooporder = new Verkooporder();
$lines = [];

foreach ($artikelen as $artikel) {
    $lines[] = (new VerkooporderRegel())
        ->setAantal(1)
        ->setArtikel($artikel)
        ->calculateAndSetTotaal()
    ;

    break;
}

$verkooporder
    ->setRelatie($klant)
    ->setDatum(new DateTimeImmutable('now', new DateTimeZone('Europe/Amsterdam')))
    ->setProcesStatus(ProcesStatus::ORDER())
    ->setVerkooporderBtwIngaveModel(VerkooporderBtwIngave::EXCLUSIEF())
    ->setKrediettermijn(14)
    ->setOmschrijving("Week 50")
    ->setRegels(...$lines)
;

$verkoopboekingConnector = new VerkooporderConnector($connection);
$verkoopboekingConnector->add($verkooporder);