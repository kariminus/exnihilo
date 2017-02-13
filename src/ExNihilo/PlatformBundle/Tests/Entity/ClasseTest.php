<?php

namespace ExNihilo\PlatformBundle\Tests\Entity;

use ExNihilo\PlatformBundle\Entity\Classe;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ClasseTest extends WebTestCase
{
    public function testName()
    {
        $classe = new Classe();
        $classe->setName("test");

        $this->assertEquals("test", $classe->getName());
    }
}