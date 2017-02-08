<?php

namespace ExNihilo\UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testRegister()
    {
        $client = static::createClient();
        $client->followRedirects();

        $crawler = $client->request('GET', '/register');


        $form = $crawler->filter('button')->form();

        $form['user_registration_form[username]'] = 'register';
        $form['user_registration_form[email]'] = 'register@mail.com';
        $form['user_registration_form[plainPassword][first]'] = 'test';
        $form['user_registration_form[plainPassword][second]'] = 'test';
        $form['user_registration_form[classe]']->select('1');
        $form['user_registration_form[race]']->select('1');
        $form['user_registration_form[gender]']->select('0');
        $form['user_registration_form[isGuildMember]']->tick();
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

        $crawler = $client->request('GET', '/admin/user/');

        $link = $crawler->selectLink('modifier')->last()->link();

        $client->click($link);

        $newCrawler = $client->request('GET', $client->getRequest()->getUri());
        $form = $newCrawler->filter('button')->form();


        $form['registration[username]'] = 'register';
        $form['registration[email]'] = 'register@mail.com';
        $form['registration[plainPassword]'] = 'test';
        $form['registration[classe]']->select('2');
        $form['registration[race]']->select('3');
        $form['registration[gender]']->select('1');
        $form['registration[isGuildMember]']->tick();
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

        $crawler = $client->request('GET', '/admin/user/');

        $link = $crawler->selectLink('supprimer')->last()->link();

        $client->click($link);

        $this->assertEquals(
            200,
            $client->getResponse()->getStatusCode()
        );
    }
}
