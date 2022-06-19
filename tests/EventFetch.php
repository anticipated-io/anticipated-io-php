<?php

namespace AnticipatedIO\Tests;

use PHPUnit\Framework\TestCase;

class EventFetchTest extends TestCase
{
    public function testRetrieveEventThatDoesNotExist()
    {
        $this->assertNotEmpty(getenv('ANTICIPATED_IO_KEY'));
        $key = trim(getenv('ANTICIPATED_IO_KEY'));
        $a = new \AnticipatedIO\Events(['key' => $key]);
        $results = $a->get('someInvalidId');
        $this->assertFalse($results->getSuccess());
        $this->assertEquals($results->getStatusCode(), 404);
    }

    public function testCreateAndRetrieveEvent()
    {
        $this->assertNotEmpty(getenv('ANTICIPATED_IO_KEY'));
        $key = trim(getenv('ANTICIPATED_IO_KEY'));
        $a = new \AnticipatedIO\Events(['key' => $key]);
        $writeResults = $a->createJson('+5 min', 'https://diagnostics.anticipated.io/v1/post', 'post', ['test' => 'php']);
        $this->assertTrue($writeResults->getSuccess());
        $this->assertEquals($writeResults->getStatusCode(), 200);

        $readResults = $a->get($writeResults->getEvent()->getId());
        $this->assertTrue($readResults->getSuccess());
        $this->assertEquals($readResults->getStatusCode(), 200);
    }
}
