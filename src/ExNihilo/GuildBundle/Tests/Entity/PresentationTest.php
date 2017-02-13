<?php

namespace ExNihilo\GuildBundle\Tests\Entity;

use ExNihilo\GuildBundle\Entity\Presentation;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PresentationTest extends WebTestCase
{
    public function testContent()
    {
        $presentation = new Presentation();
        $presentation->setContent("test");

        $this->assertEquals("test", $presentation->getContent());
    }
}