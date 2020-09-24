<?php

namespace Tests\Unit\Entity\Categories;

use App\Entity\Categories\Category;
use Tests\TestCase;

class CategoryUnitTest extends TestCase
{

    public function test_it_has_many_children()
    {
        $category = Category::factory()->has(Category::factory()->count(3), 'children')->create();

        $this->assertInstanceOf(Category::class, $category->children->first());
    }

    public function test_can_fetch_only_parents()
    {
        Category::factory(3)->has(Category::factory()->count(5), 'children')->create();

        $this->assertEquals(3, Category::parents()->count());
    }

    public function test_ordered_by_a_number()
    {
        $category = Category::factory()->create([ 'order' => 2 ]);
        $anotherCategory = Category::factory()->create([ 'order' => 1 ]);

        $this->assertEquals($anotherCategory->name, Category::ordered()->first()->name);
    }
}
