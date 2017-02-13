<?php

namespace ExNihilo\BlogBundle\Tests\Entity;

use ExNihilo\BlogBundle\Entity\Comment;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class CommentTest extends WebTestCase
{
    public function testAuthor()
    {
        $comment = new Comment();
        $comment->setAuthor("test");

        $this->assertEquals("test", $comment->getAuthor());
    }

    public function testContent()
    {
        $comment = new Comment();
        $comment->setContent("test");

        $this->assertEquals("test", $comment->getContent());
    }

    public function testCreatedAt()
    {
        $comment = new Comment();

        $this->assertEquals(new \DateTime(), $comment->getCreatedAt());
    }

}