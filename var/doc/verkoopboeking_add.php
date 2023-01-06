<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

use GuzzleHttp\Client;
use Money\Money;
use SnelstartPHP\Connector\BoekingConnector;
use SnelstartPHP\Connector\GrootboekConnector;
use SnelstartPHP\Connector\RelatieConnector;
use SnelstartPHP\Model\Boekingsregel;
use SnelstartPHP\Model\Btwregel;
use SnelstartPHP\Model\Document;
use SnelstartPHP\Model\Relatie;
use SnelstartPHP\Model\Type\BtwRegelSoort;
use SnelstartPHP\Model\Verkoopboeking;
use SnelstartPHP\Secure\AccessTokenConnection;
use SnelstartPHP\Secure\ApiSubscriptionKey;
use SnelstartPHP\Secure\BearerToken\ClientKeyBearerToken;
use SnelstartPHP\Secure\V2Connector;

require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/config.php';

global $ledgers;
global $clientKey;
global $primaryKey;
global $secondaryKey;

$client = new Client([
    //"proxy"     =>  "http://proxy.host:8888",
    "base_uri"  =>  V2Connector::getEndpoint(),
    "verify"    =>  false,
]);

$bearerToken = new ClientKeyBearerToken($clientKey);
$accessTokenConnection = new AccessTokenConnection($bearerToken);
$accessToken = $accessTokenConnection->getToken();

$connection = new V2Connector(
    new ApiSubscriptionKey($primaryKey, $secondaryKey),
    $accessToken,
    null,
    $client
);

$grootboekConnector = new GrootboekConnector($connection);
$leverancierConnector = new RelatieConnector($connection);
$klant = null;

/**
 * @var Relatie $klant
 */
foreach ($leverancierConnector->findAllKlanten() as $klant) {
    break;
}

$omzetDienstenGroot = $grootboekConnector->findByNumber($ledgers["omzetDienstenGroot"]);

if ($omzetDienstenGroot === null) {
    throw new \DomainException(sprintf("There is no ledger for number %s", $ledgers["omzetDienstenGroot"]));
}

$invoiceAmountIncl = Money::EUR(1210);
// 21% tax
$invoiceAmountExcl = $invoiceAmountIncl->divide(121)->multiply(100);

$verkoopboeking = new Verkoopboeking();
$verkoopboeking->setKlant($klant)
    ->setFactuurdatum(new \DateTimeImmutable())
    ->setVervaldatum(new \DateTimeImmutable("+14 days"))
    ->setFactuurnummer("verkoop-factuur-1")
    ->setFactuurbedrag($invoiceAmountIncl)
    ->setBoekingsregels(...[
        (new Boekingsregel())
            ->setBedrag($invoiceAmountExcl)
            ->setOmschrijving("Description")
            ->setBtwSoort(\SnelstartPHP\Model\Type\BtwSoort::HOOG())
            ->setGrootboek($omzetDienstenGroot)
    ])
    ->setBtw(...[
        (new Btwregel(
            BtwRegelSoort::VERKOPENHOOG(),
            $invoiceAmountIncl->subtract($invoiceAmountExcl)
        ))
    ])
;

$boekingConnector = new BoekingConnector($connection);
$verkoopboeking = $boekingConnector->addVerkoopboeking($verkoopboeking);
var_dump($verkoopboeking);

echo "Successfully added: " . $verkoopboeking->getUri() . "\n";
$document = Document::createFromFile(
    new SplFileObject(__DIR__ . '/../example.pdf'),
    $verkoopboeking->getId()
);
$document = $boekingConnector->addVerkoopboekingDocument($verkoopboeking, $document);
echo "Successfully added: " . $document->getUri() . "\n";