<?php

declare(strict_types=1);

/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Mapper\V2;

use Psr\Http\Message\ResponseInterface;
use SnelstartPHP\Mapper\AbstractMapper;
use SnelstartPHP\Model\V2\Document;

final class DocumentMapper extends AbstractMapper
{
    public function find(ResponseInterface $response): Document|null
    {
        $this->setResponseData($response);
        return $this->mapResponseToDocumentInstance();
    }

    public function update(ResponseInterface $response): Document
    {
        $this->setResponseData($response);
        return $this->mapResponseToDocumentInstance();
    }

    public function add(ResponseInterface $response): Document
    {
        $this->setResponseData($response);
        return $this->mapResponseToDocumentInstance();
    }

    protected function mapResponseToDocumentInstance(array $data = []): Document
    {
        $data = empty($data) ? $this->responseData : $data;

        /**
         * @var Document $document
         */
        $document = $this->mapArrayDataToModel(new Document(), $data);
        return $document;
    }
}