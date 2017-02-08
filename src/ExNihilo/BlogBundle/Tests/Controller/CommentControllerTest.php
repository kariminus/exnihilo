<?php

namespace ExNihilo\BlogBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CommentControllerTest extends WebTestCase
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

        $crawler = $client->request('GET', '/article/1/view');


        $form = $crawler->filter('button')->form();

        $form['exnihilo_blogbundle_comment[content]'] = 'Commentaire de test';


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

        $crawler = $client->request('GET', '/admin/comment/');

        $link = $crawler->selectLink('modifier')->last()->link();

        $client->click($link);


        $newCrawler = $client->request('GET', $client->getRequest()->getUri());
        $form = $newCrawler->filter('button')->form();

        $form['exnihilo_blogbundle_comment[content]'] = 'Commentaire de test édité';

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

        $crawler = $client->request('GET', '/admin/comment/');

        $link = $crawler->selectLink('supprimer')->last()->link();

        $client->click($link);

        $this->assertEquals(
            200,
            $client->getResponse()->getStatusCode()
        );
    }
}
