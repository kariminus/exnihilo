<?php

namespace ExNihilo\EventBundle\Tests\Entity;

use ExNihilo\EventBundle\Entity\Event;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EventTest extends WebTestCase
{
    public function testTitle()
    {
        $event = new Event();
        $event->setTitle("test");

        $this->assertEquals("test", $event->getTitle());
    }

    public function testContent()
    {
        $event = new Event();
        $event->setContent("test");

        $this->assertEquals("test", $event->getContent());
    }

    public function testDate()
    {
        $event = new Event();
        $event->setDate(new \DateTime());

        $this->assertEquals(new \DateTime(), $event->getDate());
    }
}