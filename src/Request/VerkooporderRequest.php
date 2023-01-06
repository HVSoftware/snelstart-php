<?php
/**
 * @author  OptiWise Technologies B.V. <info@optiwise.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Request;

use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;
use SnelstartPHP\Exception\PreValidationException;
use SnelstartPHP\Model\Verkooporder;
use SnelstartPHP\Utils;

final class VerkooporderRequest extends BaseRequest
{
    public function add(Verkooporder $verkooporder): RequestInterface
    {
        return new Request("POST", "verkooporders", [
            "Content-Type"  =>  "application/json"
        ], Utils::jsonEncode($this->prepareAddOrEditRequestForSerialization($verkooporder)));
    }

    public function delete(Verkooporder $verkooporder): RequestInterface
    {
        if ($verkooporder->getId() === null) {
            throw PreValidationException::shouldHaveAnIdException();
        }

        return new Request("DELETE", "verkooporders/" . $verkooporder->getId()->toString());
    }
}