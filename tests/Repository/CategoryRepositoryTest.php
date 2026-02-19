<?php

// test d'integration (pour savoir si on a bien intégré des données)

namespace App\Tests\Repository;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CategoryRepositoryTest extends KernelTestCase
{

    // à décommenter

//    public function testFindAll(): void
//    {
//        self::bootKernel();
//        $container = static::getContainer();
//
//        $categories = count($container->get(CategoryRepository::class)->findAll());
//        $this->assertEquals(6, $categories);
//    }

    public function testFindOneByTitle(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        $category[] = $container->get(CategoryRepository::class)->findOneBy(['title' => 'shoes']);
        $this->assertEquals(1,count($category));
    }
}
