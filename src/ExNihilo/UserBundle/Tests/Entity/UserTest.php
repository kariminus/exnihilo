<?php

namespace ExNihilo\UserBundle\Tests\Entity;

use ExNihilo\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserTest extends WebTestCase
{
    public function testUsername()
    {
        $user = new User();
        $user->setUsername("test");

        $this->assertEquals("test", $user->getUsername());
    }

    public function testEmail()
    {
        $user = new User();
        $user->setEmail("test");

        $this->assertEquals("test", $user->getEmail());
    }

    public function testPassword()
    {
        $user = new User();
        $user->setPassword("test");

        $this->assertEquals("test", $user->getPassword());
    }

    public function testGender()
    {
        $user = new User();
        $user->setGender(0);

        $this->assertEquals(0, $user->getGender());
    }

    public function testisGuildMember()
    {
        $user = new User();
        $user->setIsGuildMember(1);

        $this->assertEquals(1, $user->getIsGuildMember());
    }
}