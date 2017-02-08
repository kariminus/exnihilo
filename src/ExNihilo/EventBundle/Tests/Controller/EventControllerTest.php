<?php

namespace ExNihilo\EventBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EventControllerTest extends WebTestCase
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

        $crawler = $client->request('GET', '/admin/event/new');


        $form = $crawler->filter('button')->form();

        $form['exnihilo_eventbundle_event[title]'] = 'Evenement test';
        $form['exnihilo_eventbundle_event[date][date][day]']->select('10');
        $form['exnihilo_eventbundle_event[date][date][month]']->select('2');
        $form['exnihilo_eventbundle_event[date][date][year]']->select('2017');
        $form['exnihilo_eventbundle_event[date][time][hour]']->select('20');
        $form['exnihilo_eventbundle_event[date][time][minute]']->select('00');
        $form['exnihilo_eventbundle_event[content]'] = 'Test';

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

        $crawler = $client->request('GET', '/admin/event/');

        $link = $crawler->selectLink('modifier')->last()->link();

        $client->click($link);

        $newCrawler = $client->request('GET', $client->getRequest()->getUri());
        $form = $newCrawler->filter('button')->form();

        $form['exnihilo_eventbundle_event[title]'] = 'Evenement test';
        $form['exnihilo_eventbundle_event[date][date][day]']->select('11');
        $form['exnihilo_eventbundle_event[date][date][month]']->select('3');
        $form['exnihilo_eventbundle_event[date][date][year]']->select('2017');
        $form['exnihilo_eventbundle_event[date][time][hour]']->select('21');
        $form['exnihilo_eventbundle_event[date][time][minute]']->select('00');
        $form['exnihilo_eventbundle_event[content]'] = 'Test edit';

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

        $crawler = $client->request('GET', '/admin/event/');

        $link = $crawler->selectLink('supprimer')->last()->link();

        $client->click($link);

        $this->assertEquals(
            200,
            $client->getResponse()->getStatusCode()
        );
    }


}
