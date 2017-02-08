<?php

namespace ExNihilo\BlogBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

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

        $form['exnihilo_blogbundle_article[title]'] = 'Bienvenue';
        $form['exnihilo_blogbundle_article[content]'] = 'Bienvenue';
        $form['exnihilo_blogbundle_article[image][file]']->upload('%kernel.root_dir%/../web/images/img.jpg');

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

        $form['exnihilo_blogbundle_article[title]'] = 'Bienvenue';
        $form['exnihilo_blogbundle_article[content]'] = 'Bienvenue';
        $form['exnihilo_blogbundle_article[image][file]']->upload('%kernel.root_dir%/../web/images/img.jpg');

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
