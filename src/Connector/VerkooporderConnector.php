<?php
/**
 * @author  OptiWise Technologies B.V. <info@optiwise.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Connector;

use SnelstartPHP\Exception\PreValidationException;
use SnelstartPHP\Mapper\VerkooporderMapper;
use SnelstartPHP\Model\Verkooporder;
use SnelstartPHP\Request\VerkooporderRequest;

final class VerkooporderConnector extends BaseConnector
{
    public function add(Verkooporder $verkooporder): Verkooporder
    {
        if ($verkooporder->getId() !== null) {
            throw PreValidationException::unexpectedIdException();
        }

        $verkooporderMapper = new VerkooporderMapper();
        $verkooporderRequst = new VerkooporderRequest();

        return $verkooporderMapper->add($this->connection->doRequest($verkooporderRequst->add($verkooporder)));
    }

    public function delete(Verkooporder $verkooporder): void
    {
        if ($verkooporder->getId() !== null) {
            throw PreValidationException::shouldHaveAnIdException();
        }

        $verkooporderMapper = new VerkooporderMapper();
        $verkooporderRequst = new VerkooporderRequest();

        $verkooporderMapper->delete($this->connection->doRequest($verkooporderRequst->delete($verkooporder)));
    }
}