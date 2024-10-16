<?php

namespace SnelstartPHP\Tests\Request\V2;

use GuzzleHttp\Psr7\Request;
use Ramsey\Uuid\Uuid;
use SnelstartPHP\Request\V2\LandRequest;
use PHPUnit\Framework\TestCase;

final class LandRequestTest extends TestCase
{
    private LandRequest $landRequest;

    public function setUp(): void
    {
        $this->landRequest = new LandRequest();
    }

    public function testFindAll()
    {
        $this->assertEquals(new Request("GET", "landen"), $this->landRequest->findAll());
    }

    public function testFindById()
    {
        $id = Uuid::uuid4();
        $this->assertEquals(new Request("GET", "landen/" . $id->toString()), $this->landRequest->find($id));
    }
}
