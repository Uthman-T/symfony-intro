<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Security\Core\User\InMemoryUser;

class ProductControllerTest extends WebTestCase
{
    public function testNewProductFormSubmit(): void
    {
        $client = self::createClient();

        $user = new InMemoryUser('admin', 'password', ['ROLE_ADMIN']);
        $client->loginUser($user);

        $crawler = $client->request('GET', '/admin/product/new');

        $buttonCrawlerNode = $crawler->selectButton('Save');

        $form = $buttonCrawlerNode->form();

        $form['product[category]']->select('Jeans');

        $client->submit($form, [
            'product[title]' => 'Pablo',
            'product[description]' => 'Pablo es mucho euh... jsp;',
            'product[price]' => 72.5
        ]);

        $this->assertResponseRedirects('/admin/product');
    }
}
