<?php

declare(strict_types=1);

/**
 * @author     IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project    SnelstartApiPHP
 * @deprecated
 */

namespace SnelstartPHP\Mapper\V2;

use DateTimeImmutable;
use Exception;
use Generator;
use SnelstartPHP\Model\V2\Boeking;
use SnelstartPHP\Model\V2\Boekingsregel;
use SnelstartPHP\Model\V2\Document;
use SnelstartPHP\Model\V2\Grootboek;
use SnelstartPHP\Model\V2\Inkoopboeking;
use SnelstartPHP\Model\V2\Inkoopfactuur;
use SnelstartPHP\Model\V2\Relatie;
use SnelstartPHP\Model\V2\Verkoopboeking;
use SnelstartPHP\Model\V2\Verkoopfactuur;
use function array_map;
use Psr\Http\Message\ResponseInterface;
use Ramsey\Uuid\Uuid;
use SnelstartPHP\Mapper\AbstractMapper;
use SnelstartPHP\Model\IncassoMachtiging;
use SnelstartPHP\Model\Kostenplaats;
use SnelstartPHP\Model\V2 as Model;
use SnelstartPHP\Model\Type;

final class BoekingMapper extends AbstractMapper
{
    public function findInkoopboeking(ResponseInterface $response): Inkoopboeking
    {
        $this->setResponseData($response);
        return $this->mapInkoopboekingResult(new Inkoopboeking());
    }

    /**
     * @throws Exception
     */
    public function findVerkoopboeking(ResponseInterface $response): Verkoopboeking
    {
        $this->setResponseData($response);
        return $this->mapVerkoopboekingResult(new Verkoopboeking());
    }

    /**
     * @throws Exception
     */
    public function findAllInkoopboekingen(ResponseInterface $response): Generator
    {
        $this->setResponseData($response);
        yield from $this->mapManyResultsToSubMappers(Inkoopboeking::class);
    }

    /**
     * @throws Exception
     */
    public function findAllInkoopfacturen(ResponseInterface $response): Generator
    {
        $this->setResponseData($response);
        return $this->mapManyResultsToSubMappers(Inkoopfactuur::class);
    }

    /**
     * @throws Exception
     */
    public function findAllVerkoopboekingen(ResponseInterface $response): Generator
    {
        $this->setResponseData($response);
        yield from $this->mapManyResultsToSubMappers(Verkoopboeking::class);
    }

    /**
     * @throws Exception
     */
    public function findAllVerkoopfacturen(ResponseInterface $response): Generator
    {
        $this->setResponseData($response);
        return $this->mapManyResultsToSubMappers(Verkoopfactuur::class);
    }

    public function addInkoopboeking(ResponseInterface $response): Inkoopboeking
    {
        $this->setResponseData($response);
        return $this->mapInkoopboekingResult(new Inkoopboeking());
    }

    public function updateInkoopboeking(ResponseInterface $response): Inkoopboeking
    {
        $this->setResponseData($response);
        return $this->mapInkoopboekingResult(new Inkoopboeking());
    }

    /**
     * @throws Exception
     */
    public function updateVerkoopboeking(ResponseInterface $response): Verkoopboeking
    {
        $this->setResponseData($response);
        return $this->mapVerkoopboekingResult(new Verkoopboeking());
    }

    /**
     * @throws Exception
     */
    public function addVerkoopboeking(ResponseInterface $response): Verkoopboeking
    {
        $this->setResponseData($response);
        return $this->mapVerkoopboekingResult(new Verkoopboeking());
    }

    protected function mapDocumentResult(array $data = []): Document
    {
        $data = empty($data) ? $this->responseData : $data;
        return $this->mapArrayDataToModel(new Document(), $data);
    }

    protected function mapInkoopboekingResult(Inkoopboeking $inkoopboeking, array $data = []): Inkoopboeking
    {
        $data = empty($data) ? $this->responseData : $data;

        /**
         * @var Inkoopboeking $inkoopboeking
         */
        $inkoopboeking = $this->mapBoekingResult($inkoopboeking, $data);

        if (isset($data["leverancier"])) {
            $inkoopboeking->setLeverancier(Relatie::createFromUUID(Uuid::fromString($data["leverancier"]["id"])));
        }

        return $inkoopboeking;
    }

    /**
     * @throws Exception
     */
    protected function mapVerkoopboekingResult(Verkoopboeking $verkoopboeking, array $data = []): Verkoopboeking
    {
        $data = empty($data) ? $this->responseData : $data;

        /**
         * @var Verkoopboeking $verkoopboeking
         */
        $verkoopboeking = $this->mapBoekingResult($verkoopboeking, $data);

        if (isset($data["klant"])) {
            $verkoopboeking->setKlant(Relatie::createFromUUID(Uuid::fromString($data["klant"]["id"])));
        } elseif (isset($data["relatie"])) {
            $verkoopboeking->setKlant(Relatie::createFromUUID(Uuid::fromString($data["relatie"]["id"])));
        }

        if (isset($data["doorlopendeIncassoMachtiging"]["id"])) {
            $doorlopendeIncassoMachtiging = IncassoMachtiging::createFromUUID(
                Uuid::fromString($data["doorlopendeIncassoMachtiging"]["id"])
            );
            $verkoopboeking->setDoorlopendeIncassoMachtiging($doorlopendeIncassoMachtiging);
        }

        if (isset($data["eenmaligeIncassoMachtiging"]["datum"])) {
            $incassomachtiging = (new IncassoMachtiging())
                ->setDatum(new DateTimeImmutable($data["eenmaligeIncassoMachtiging"]["datum"]));

            if ($data["eenmaligeIncassoMachtiging"]["kenmerk"] !== null) {
                $incassomachtiging->setKenmerk($data["eenmaligeIncassoMachtiging"]["kenmerk"]);
            }

            if (isset($data["eenmaligeIncassoMachtiging"]["omschrijving"])) {
                $incassomachtiging->setOmschrijving($data["eenmaligeIncassoMachtiging"]["omschrijving"]);
            }

            $verkoopboeking->setEenmaligeIncassoMachtiging($incassomachtiging);
        }

        return $verkoopboeking;
    }

    /**
     * @throws Exception
     */
    protected function mapVerkoopfactuurResult(Verkoopfactuur $verkoopfactuur, array $data = []): Verkoopfactuur
    {
        $data = empty($data) ? $this->responseData : $data;

        // This maps "id", "uri", "modifiedOn" and "factuurnummer".
        $verkoopfactuur = $this->mapArrayDataToModel($verkoopfactuur, $data);

        if (isset($data['relatie'])) {
            $verkoopfactuur->setRelatie(Relatie::createFromUUID(Uuid::fromString($data['relatie']['id'])));
        }

        if (isset($data['verkoopBoeking'])) {
            $verkoopfactuur->setVerkoopBoeking(
                Verkoopboeking::createFromUUID(Uuid::fromString($data['verkoopBoeking']['id']))
            );
        }

        if (isset($data['factuurDatum'])) {
            $verkoopfactuur->setFactuurDatum(new DateTimeImmutable($data['factuurDatum']));
        }

        if (isset($data['factuurBedrag'])) {
            $verkoopfactuur->setFactuurBedrag($this->getMoney($data['factuurBedrag']));
        }

        if (isset($data['openstaandSaldo'])) {
            $verkoopfactuur->setOpenstaandSaldo($this->getMoney($data['openstaandSaldo']));
        }

        if (isset($data['vervalDatum'])) {
            $verkoopfactuur->setVervalDatum(new DateTimeImmutable($data['vervalDatum']));
        }

        return $verkoopfactuur;
    }

    /**
     * @throws Exception
     */
    protected function mapInkoopfactuurResult(Model\Inkoopfactuur $inkoopfactuur, array $data = []): Inkoopfactuur
    {
        $data = empty($data) ? $this->responseData : $data;

        // This maps "id", "uri", "modifiedOn" and "factuurnummer".
        $inkoopfactuur = $this->mapArrayDataToModel($inkoopfactuur, $data);

        if (isset($data['relatie'])) {
            $inkoopfactuur->setRelatie(Relatie::createFromUUID(Uuid::fromString($data['relatie']['id'])));
        }

        if (isset($data['inkoopBoeking'])) {
            $inkoopfactuur->setInkoopboeking(
                Inkoopboeking::createFromUUID(Uuid::fromString($data['inkoopBoeking']['id']))
            );
        }

        if (isset($data['factuurDatum'])) {
            $inkoopfactuur->setFactuurDatum(new DateTimeImmutable($data['factuurDatum']));
        }

        if (isset($data['factuurBedrag'])) {
            $inkoopfactuur->setFactuurBedrag($this->getMoney($data['factuurBedrag']));
        }

        if (isset($data['openstaandSaldo'])) {
            $inkoopfactuur->setOpenstaandSaldo($this->getMoney($data['openstaandSaldo']));
        }

        if (isset($data['vervalDatum'])) {
            $inkoopfactuur->setVervalDatum(new DateTimeImmutable($data['vervalDatum']));
        }

        return $inkoopfactuur;
    }

    /**
     * @throws Exception
     */
    protected function mapBoekingResult(Boeking $boeking, array $data = []): Boeking
    {
        $data = empty($data) ? $this->responseData : $data;

        /**
         * @var Boeking $boeking
         */
        $boeking = $this->mapArrayDataToModel($boeking, $data);

        if (isset($data["modifiedOn"])) {
            $boeking->setModifiedOn(new DateTimeImmutable($data["modifiedOn"]));
        }

        if (isset($data["factuurDatum"])) {
            $boeking->setFactuurdatum(new DateTimeImmutable($data["factuurDatum"]));
        }

        if (isset($data["vervalDatum"])) {
            $boeking->setVervaldatum(new DateTimeImmutable($data["vervalDatum"]));
        }

        if (isset($data["factuurBedrag"])) {
            $boeking->setFactuurbedrag($this->getMoney($data["factuurBedrag"]));
        }

        if (isset($data["boekingsregels"])) {
            $boeking->setBoekingsregels(
                ...array_map(
                    function (array $boekingsregel): Boekingsregel {
                        $boekingsregelObject = (new Boekingsregel())
                            ->setBedrag($this->getMoney($boekingsregel["bedrag"]))
                            ->setBtwSoort(new Type\BtwSoort($boekingsregel["btwSoort"]));

                        if (isset($boekingsregel["omschrijving"])) {
                            $boekingsregelObject->setOmschrijving($boekingsregel["omschrijving"]);
                        }

                        if (isset($boekingsregel["grootboek"])) {
                            $boekingsregelObject
                            ->setGrootboek(
                                Grootboek::createFromUUID(Uuid::fromString($boekingsregel["grootboek"]["id"]))
                            );
                        }

                        if (isset($boekingsregel["kostenplaats"])) {
                            $boekingsregelObject->setKostenplaats(
                                Kostenplaats::createFromUUID(Uuid::fromString($boekingsregel["kostenplaats"]["id"]))
                            );
                        }

                        return $boekingsregelObject;
                    }, $data["boekingsregels"]
                )
            );
        }

        if (isset($data["btw"])) {
            $boeking->setBtw(
                ...array_map(
                    function (array $btw): Model\Btwregel {
                        return new Model\Btwregel(
                            new Type\BtwRegelSoort($btw["btwSoort"]),
                            $this->getMoney($btw["btwBedrag"])
                        );
                    }, $data["btw"]
                )
            );
        }

        if (isset($data["documents"])) {
            foreach ($data["documents"] as $document) {
                $boeking->addDocument($this->mapDocumentResult($document));
            }
        }

        return $boeking;
    }

    /**
     * @throws Exception
     */
    public function mapManyResultsToSubMappers(string $className): Generator
    {
        foreach ($this->responseData as $boekingData) {
            if ($className === Model\Inkoopboeking::class) {
                yield $this->mapInkoopboekingResult(new $className(), $boekingData);
            } elseif ($className === Verkoopboeking::class) {
                yield $this->mapVerkoopboekingResult(new $className(), $boekingData);
            } elseif ($className === Verkoopfactuur::class) {
                yield $this->mapVerkoopfactuurResult(new $className(), $boekingData);
            } elseif ($className === Inkoopfactuur::class) {
                yield $this->mapInkoopfactuurResult(new $className(), $boekingData);
            }
        }
    }
}
