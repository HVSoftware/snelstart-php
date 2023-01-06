<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

use Money\Money;
use SnelstartPHP\Connector\BoekingConnector;
use SnelstartPHP\Connector\GrootboekConnector;
use SnelstartPHP\Connector\RelatieConnector;
use SnelstartPHP\Model\Type\BtwRegelSoort;
use SnelstartPHP\Model\Boekingsregel;
use SnelstartPHP\Model\Btwregel;
use SnelstartPHP\Model\Inkoopboeking;
use SnelstartPHP\Model\Relatie;
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
global $ledgers;

$bearerToken = new ClientKeyBearerToken($clientKey);
$accessTokenConnection = new AccessTokenConnection($bearerToken);
$accessToken = $accessTokenConnection->getToken();

$connection = new V2Connector(
    new ApiSubscriptionKey($primaryKey, $secondaryKey),
    $accessToken
);

$leverancierConnector = new RelatieConnector($connection);
$leverancier = null;

/**
 * @var Relatie $leverancier
 */
foreach ($leverancierConnector->findAllLeveranciers() as $leverancier) {
    break;
}

$grootboekConnector = new GrootboekConnector($connection);

$inkoopGroot = iterator_to_array($grootboekConnector->findAll(
    (new ODataRequestData())
        ->setFilter([
            sprintf("Nummer eq %d", $ledgers["inkoopGroot"])
        ]))
)[0] ?? null;

if ($inkoopGroot === null) {
    throw new \Exception("Not found");
}

$inkoopboeking = new Inkoopboeking();
$inkoopboeking->setLeverancier($leverancier)
    ->setFactuurdatum(new \DateTime())
    ->setFactuurnummer("inkoop-factuur-1")
    ->setFactuurbedrag(\Money\Money::EUR(1223))
    ->setBoekingsregels(...[
        (new Boekingsregel())
            ->setBedrag(\Money\Money::EUR(1011))
            ->setOmschrijving("Omschrijving")
            ->setBtwSoort(\SnelstartPHP\Model\Type\BtwSoort::HOOG())
            ->setGrootboek($inkoopGroot)
    ])
    ->setBtw(...[
        (new Btwregel(BtwRegelSoort::INKOPENHOOG(), Money::EUR(212)))
    ])
;

$boekingConnector = new BoekingConnector($connection);
$boekingConnector->addInkoopboeking($inkoopboeking);