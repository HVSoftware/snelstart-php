<?php

declare(strict_types=1);

/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Mapper\V2;

use Generator;
use Psr\Http\Message\ResponseInterface;
use SnelstartPHP\Mapper\AbstractMapper;
use SnelstartPHP\Model\V2\ArtikelOmzetgroep;

use function assert;

final class ArtikelOmzetgroepMapper extends AbstractMapper
{
    public function find(ResponseInterface $response): ArtikelOmzetgroep|null
    {
        $this->setResponseData($response);

        return $this->mapResponseToArtikelOmzetgroepModel(new ArtikelOmzetgroep());
    }

    public function findAll(ResponseInterface $response): Generator
    {
        $this->setResponseData($response);

        foreach ($this->responseData as $data) {
            yield $this->mapResponseToArtikelOmzetgroepModel(new ArtikelOmzetgroep(), $data);
        }
    }

    protected function mapResponseToArtikelOmzetgroepModel(
        ArtikelOmzetgroep $artikelOmzetgroep,
        array $data = [],
    ): ArtikelOmzetgroep {
        $data = empty($data) ? $this->responseData : $data;

        $artikelOmzetgroep = $this->mapArrayDataToModel($artikelOmzetgroep, $data);
        assert($artikelOmzetgroep instanceof ArtikelOmzetgroep);

        return $artikelOmzetgroep;
    }

    /**
     * Map many results to the mapper.
     */
    protected function mapManyResultsToSubMappers(): Generator
    {
        foreach ($this->responseData as $artikelOmzetgroepData) {
            yield $this->mapResponseToArtikelOmzetgroepModel(new ArtikelOmzetgroep(), $artikelOmzetgroepData);
        }
    }
}
