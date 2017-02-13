<?php

namespace ExNihilo\PlatformBundle\Tests\Entity;

use ExNihilo\PlatformBundle\Entity\Race;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RaceTest extends WebTestCase
{
    public function testName()
    {
        $race = new Race();
        $race->setName("test");

        $this->assertEquals("test", $race->getName());
    }
}