<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Mapper;

use Psr\Http\Message\ResponseInterface;
use SnelstartPHP\Model\Land;

final class LandMapper extends AbstractMapper
{
    public function find(ResponseInterface $response): ?Land
    {
        $this->setResponseData($response);
        return $this->mapArrayDataToModel(new Land());
    }

    public function findAll(ResponseInterface $response): \Generator
    {
        $this->setResponseData($response);

        foreach ($this->responseData as $landData) {
            yield $this->mapArrayDataToModel(new Land(), $landData);
        }
    }
}