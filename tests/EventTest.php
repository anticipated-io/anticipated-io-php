<?php

namespace AnticipatedIO\Tests;

use PHPUnit\Framework\TestCase;

class EventTest extends TestCase
{
    public function testCreateInFuture()
    {
        $this->assertNotEmpty(getenv('ANTICIPATED_IO_KEY'));
        $key = trim(getenv('ANTICIPATED_IO_KEY'));
        $a = new \AnticipatedIO\Events(['key' => $key]);
        $results = $a->createJson('+5 min', 'https://diagnostics.anticipated.io/v1/post', 'post', ['test' => 'php']);
        $this->assertTrue($results->getSuccess());
        $this->assertEquals($results->getStatusCode(), 200);
    }

    public function testCreateInPast()
    {
        $this->assertNotEmpty(getenv('ANTICIPATED_IO_KEY'));
        $key = trim(getenv('ANTICIPATED_IO_KEY'));
        $a = new \AnticipatedIO\Events(['key' => $key]);
        $results = $a->createJson('-5 min', 'https://diagnostics.anticipated.io/v1/post', 'post', ['test' => 'php']);
        $this->assertFalse($results->getSuccess());
        $this->assertEquals($results->getStatusCode(), 400);
    }

    public function testCreateAtSpecificTime()
    {
        $this->assertNotEmpty(getenv('ANTICIPATED_IO_KEY'));
        $key = trim(getenv('ANTICIPATED_IO_KEY'));
        $a = new \AnticipatedIO\Events(['key' => $key]);
        $dte = new \DateTime('now', new \DateTimeZone('UTC'));
        $dte->modify('+5 min');
        $dateTimeFormatted = $dte->format(\DateTime::ATOM);
        $results = $a->createJson($dateTimeFormatted, 'https://diagnostics.anticipated.io/v1/post', 'post', ['test' => 'php']);
        var_dump($results);
        $this->assertTrue($results->getSuccess());
        $this->assertEquals($results->getStatusCode(), 200);
        $this->assertEquals($results->getEvent()->getWhen()->format(\DateTimeInterface::ISO8601), $dte->format(\DateTimeInterface::ISO8601));
    }
}
