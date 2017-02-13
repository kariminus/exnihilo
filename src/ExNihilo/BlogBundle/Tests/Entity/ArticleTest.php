<?php

namespace ExNihilo\BlogBundle\Tests\Entity;

use ExNihilo\BlogBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ArticleTest extends WebTestCase
{

    public function testTitle()
    {
        $article = new Article();
        $article->setTitle("Test");

        $this->assertEquals("Test", $article->getTitle());
    }

    public function testContent()
    {
        $article = new Article();
        $article->setContent("Test");

        $this->assertEquals("Test", $article->getContent());
    }

    public function testCreatedAt()
    {
        $article = new Article();

        $this->assertEquals(new \DateTime(), $article->getCreatedAt());
    }

}