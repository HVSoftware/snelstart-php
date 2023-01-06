<?php

declare(strict_types=1);

namespace SnelstartPHP\Mapper;

use Psr\Http\Message\ResponseInterface;
use SnelstartPHP\Model as Model;
use SnelstartPHP\Model\Type;

final class BtwTariefMapper extends AbstractMapper
{
    public function findAll(ResponseInterface $response): \Generator
    {
        $this->setResponseData($response);

        foreach ($this->responseData as $data) {
            yield (new Model\BtwTarief())
                ->setBtwSoort(new Type\BtwSoort($data["btwSoort"]))
                ->setBtwPercentage((float) $data['btwPercentage'])
                ->setDatumVanaf(new \DateTimeImmutable($data["datumVanaf"]))
                ->setDatumTotEnMet(new \DateTimeImmutable($data["datumTotEnMet"]));
        }
    }
}
