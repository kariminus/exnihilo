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


        $crawler = $client->request('GET', '/admin/presentation/1/edit');

        $form = $crawler->filter('button')->form();


        $file = new UploadedFile('C:\Users\karim\Desktop\images\guilde\illidan.jpg', 'illidan.jpg');


        $form->setValues(array(
            'presentation[content]' => 'Presentation test',
            'presentation[imagePresentations][0][file]' => $file,
            'presentation[imagePresentations][1][file]' => $file,

        ));

        $values = $form->getPhpValues();

        $client->request($form->getMethod(), $form->getUri(), $values,
            $form->getPhpFiles());


        $this->assertEquals(
            200,
            $client->getResponse()->getStatusCode()
        );

    }
}
