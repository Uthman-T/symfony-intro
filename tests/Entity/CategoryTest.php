<?php

namespace App\Tests\Entity;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CategoryTest extends KernelTestCase
{
    public function testValidEntity()
    {
        self::bootKernel();

        $category = new Category();
        $category->setTitle('T-Shirt');

        $error = self::getContainer()->get('validator')->validate($category);
        $this->assertEquals(0, $error->count());

    }

    public function testValidEntityEmptyTitle()
    {
        self::bootKernel();

        $category = new Category();
        $category->setTitle('');

        $error = self::getContainer()->get('validator')->validate($category);
        $this->assertEquals(1, $error->count());

    }
}
