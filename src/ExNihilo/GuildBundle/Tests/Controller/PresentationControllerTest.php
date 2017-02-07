<?php

namespace ExNihilo\GuildBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PresentationControllerTest extends WebTestCase
{
    public function testEditPresentation()
    {
        $client = static::createClient();
        $client->followRedirects();

        $crawler = $client->request('GET', '/login');


        $formLogin = $crawler->filter('button')->form();

        $formLogin['login_form[_username]'] = 'admin';
        $formLogin['login_form[_password]'] = 'admin';
        $client->submit($formLogin);


        $crawler = $client->request('GET', '/admin/presentation/new');

        $form = $crawler->filter('button')->form();
        $form['presentation[content]'] = 'test';

        $values = $form->getPhpValues();

        $values['presentation']['imagePresentations'][0]['file'] = '';

        $crawler = $client->request($form->getMethod(), $form->getUri(), $values,
            $form->getPhpFiles());

        $this->assertEquals(1, $crawler->filter('ul.imagePresentations > li')->count());

    }
}
