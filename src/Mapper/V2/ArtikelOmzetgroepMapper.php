<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Mapper\V2;

use Psr\Http\Message\ResponseInterface;
use SnelstartPHP\Mapper\AbstractMapper;
use SnelstartPHP\Model\V2\ArtikelOmzetgroep;

final class ArtikelOmzetgroepMapper extends AbstractMapper
{
    public function find(ResponseInterface $response): ?ArtikelOmzetgroep
    {
        $this->setResponseData($response);
        return $this->mapResponseToArtikelOmzetgroepModel(new ArtikelOmzetgroep());
    }

    public function findAll(ResponseInterface $response): \Generator
    {
        $this->setResponseData($response);

        foreach ($this->responseData as $data) {
            yield $this->mapResponseToArtikelOmzetgroepModel(new ArtikelOmzetgroep(), $data);
        }
    }

    protected function mapResponseToArtikelOmzetgroepModel(ArtikelOmzetgroep $artikelOmzetgroep, array $data = []): ArtikelOmzetgroep
    {
        $data = empty($data) ? $this->responseData : $data;

        /**
         * @var ArtikelOmzetgroep $artikelOmzetgroep
         */
        $artikelOmzetgroep = $this->mapArrayDataToModel($artikelOmzetgroep, $data);

        return $artikelOmzetgroep;
    }

    /**
     * Map many results to the mapper.
     */
    protected function mapManyResultsToSubMappers(): \Generator
    {
        foreach ($this->responseData as $artikelOmzetgroepData) {
            yield $this->mapResponseToArtikelOmzetgroepModel(new ArtikelOmzetgroep(), $artikelOmzetgroepData);
        }
    }
}
