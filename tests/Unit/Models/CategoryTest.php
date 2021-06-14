<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CategoryTest extends TestCase
{
    public function test_contains_valid_fillable_properties()
    {
        $category = new Category();

        $this->assertEquals(['name', 'parent_id'], $category->getFillable());
    }

    public function test_category_books_relation()
    {   
        $category = new Category();
        $relation = $category->books();
        
        $this->assertInstanceOf(BelongsToMany::class, $relation);
        $this->assertEquals('book_categories', $relation->getTable());
        $this->assertEquals('book_categories.category_id', $relation->getQualifiedForeignPivotKeyName());
        $this->assertEquals('book_categories.book_id', $relation->getQualifiedRelatedPivotKeyName());
    }

    public function test_category_childrent_relation()
    {   
        $category = new Category();
        $relation = $category->childrent();

        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('categories.parent_id', $relation->getQualifiedForeignKeyName());
    }

    public function test_category_parent_relation()
    {
        $category = new Category();
        $relation = $category->parent();

        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('parent_id', $relation->getForeignKeyName());
        $this->assertEquals('id', $relation->getOwnerKeyName());
    }

    public function test_properties_have_valid_values()
    {
        Category::unguard();
        $initial = [
            'name' => 'Kiem hiep',
            'parent_id' => 2,
        ];
        $category = new Category($initial);
        $this->assertEquals($initial, $category->attributesToArray());
    }

    public function test_category_getter() {
        $category = new Category();
        $category->setAttribute('name', 'Kiem hiep');
        $this->assertEquals('Kiem hiep', $category->getAttributeValue('name'));
    }
}
