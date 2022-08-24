<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminLoginTest extends WebTestCase
{
    public function testEditorOrWriterCanLogin(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');

        $crawler = $client->submitForm('Sign in', [
            'email' => 'editor@example.com',
            'password' => '123',
        ]);

        // vérifie que la validation du formulaire renvoie une redirection vers la route '/admin/article/'
        $this->assertResponseRedirects('/admin/article/');

        // suivre la redirection
        // tant que la redirection n'est pas suivie, on reste sur la page de login
        $crawler = $client->followRedirect();

        // vérifie que nous sommes dans la page '/admin/article/' après redirection
        $this->assertEquals(
            $client->getRequest()->getUri(),
            'http://localhost/admin/article/'
        );
    }
}
