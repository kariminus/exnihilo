<?php

namespace ExNihilo\BlogBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ArticleControllerTest extends WebTestCase
{
    public function testNew()
    {
        $client = static::createClient();
        $client->followRedirects();

        $crawler = $client->request('GET', '/login');


        $formLogin = $crawler->filter('button')->form();

        $formLogin['login_form[_username]'] = 'admin';
        $formLogin['login_form[_password]'] = 'admin';
        $client->submit($formLogin);

        $crawler = $client->request('GET', '/admin/article/new');


        $form = $crawler->filter('button')->form();
        $file = new UploadedFile('C:\Users\karim\Desktop\images\test.png', 'test.png');

        $form['exnihilo_blogbundle_article[title]'] = 'Bienvenue';
        $form['exnihilo_blogbundle_article[content]'] = 'Bienvenue';
        $form['exnihilo_blogbundle_article[image][file]'] = $file;

        $client->submit($form);

        $this->assertEquals(
            200,
            $client->getResponse()->getStatusCode()
        );

    }

    public function testEdit()
    {
        $client = static::createClient();
        $client->followRedirects();

        $crawler = $client->request('GET', '/login');


        $formLogin = $crawler->filter('button')->form();

        $formLogin['login_form[_username]'] = 'admin';
        $formLogin['login_form[_password]'] = 'admin';
        $client->submit($formLogin);

        $crawler = $client->request('GET', '/admin/article/');

        $link = $crawler->selectLink('modifier')->last()->link();

        $client->click($link);

        $newCrawler = $client->request('GET', $client->getRequest()->getUri());
        $form = $newCrawler->filter('button')->form();

        $file = new UploadedFile('C:\Users\karim\Desktop\images\test.png', 'test.png');

        $form['exnihilo_blogbundle_article[title]'] = 'Bienvenue';
        $form['exnihilo_blogbundle_article[content]'] = 'Bienvenue';
        $form['exnihilo_blogbundle_article[image][file]'] = $file;

        $client->submit($form);

        $this->assertEquals(
            200,
            $client->getResponse()->getStatusCode()
        );

    }

    public function testDelete()
    {
        $client = static::createClient();
        $client->followRedirects();

        $crawler = $client->request('GET', '/login');


        $formLogin = $crawler->filter('button')->form();

        $formLogin['login_form[_username]'] = 'admin';
        $formLogin['login_form[_password]'] = 'admin';
        $client->submit($formLogin);

        $crawler = $client->request('GET', '/admin/article/');

        $link = $crawler->selectLink('supprimer')->last()->link();

        $client->click($link);

        $this->assertEquals(
            200,
            $client->getResponse()->getStatusCode()
        );
    }
}
