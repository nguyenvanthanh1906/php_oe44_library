<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Book;
use App\Models\Puplisher;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BookTest extends TestCase
{
    public function test_contains_valid_fillable_properties()
    {
        $book = new Book();

        $this->assertEquals(['name', 'amount', 'puplisher_id', 'status_id', 'thumbnail'], $book->getFillable());
    }

    public function test_book_puplishers_relation()
    {   
        $book = new Book();
        $relation = $book->puplisher();
        
        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('puplisher_id', $relation->getForeignKeyName());
        $this->assertEquals('id', $relation->getOwnerKeyName());
    }

    public function test_book_status_relation()
    {
        $book = new Book();
        $relation = $book->status();
        
        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('status_id', $relation->getForeignKeyName());
        $this->assertEquals('id', $relation->getOwnerKeyName());
    }

    public function test_book_categories_relation()
    {   
        $book = new Book();
        $relation = $book->categories();
        
        $this->assertInstanceOf(BelongsToMany::class, $relation);
        $this->assertEquals('book_categories', $relation->getTable());
        $this->assertEquals('book_categories.book_id', $relation->getQualifiedForeignPivotKeyName());
        $this->assertEquals('book_categories.category_id', $relation->getQualifiedRelatedPivotKeyName());
    }

    public function test_book_authors_relation()
    {   
        $book = new Book();
        $relation = $book->authors();
        
        $this->assertInstanceOf(BelongsToMany::class, $relation);
        $this->assertEquals('author_books', $relation->getTable());
        $this->assertEquals('author_books.book_id', $relation->getQualifiedForeignPivotKeyName());
        $this->assertEquals('author_books.author_id', $relation->getQualifiedRelatedPivotKeyName());
    }

    public function test_book_requests_relation()
    {   
        $book = new Book();
        $relation = $book->requests();
       
        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('c_requests.book_id', $relation->getQualifiedForeignKeyName());
    }

    public function test_properties_have_valid_values()
    {
        Book::unguard();
        $initial = [
            'name' => 'Tam Cam',
            'amount' => 30,
            'puplisher_id' => 2,
            'status_id' => 2,
            'thumbnail' => '32a6354cc014e821032432971cd0e26e.png',
        ];
        $book = new Book($initial);
        $this->assertEquals($initial, $book->attributesToArray());
    }

    public function test_book_getter() {
        $book = new Book();
        $book->setAttribute('name', 'Tam Cam');
        $this->assertEquals('Tam Cam', $book->getAttributeValue('name'));
    }
}
