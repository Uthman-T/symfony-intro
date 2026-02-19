<?php

namespace App\Tests\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Security\Core\User\InMemoryUser;

class ProductControllerTest extends WebTestCase
{
    private static ?int $id = null;

    public function testCreateProduct(): void
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

        $client->submit($form);

        $container = self::getContainer();
        $product = $container->get(ProductRepository::class)->findOneBy(['title' => 'Pablo']);
        self::$id = $product->getId();

        $this->assertResponseRedirects('/admin/product');
    }

    public function testEditProduct(): void
    {
        $client = self::createClient();

        $user = new InMemoryUser('admin', 'password', ['ROLE_ADMIN']);
        $client->loginUser($user);

        $crawler = $client->request('GET', '/admin/product/' . self::$id . '/edit');
        $buttonCrawlerNode = $crawler->selectButton('Update');
        $form = $buttonCrawlerNode->form();

        $form['product[category]']->select('Jeans');
        $client->submit($form, [
            'product[title]' => 'Pablito',
            'product[description]' => 'bla bla bla bla;',
            'product[price]' => 149.2
        ]);

        $client->submit($form);

        $this->assertResponseRedirects('/admin/product');
    }
}
