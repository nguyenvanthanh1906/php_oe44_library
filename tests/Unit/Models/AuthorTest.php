<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AuthorTest extends TestCase
{
    use WithFaker;

    public function test_contains_valid_fillable_properties()
    {
        $author = new Author();

        $this->assertEquals(['name', 'description'], $author->getFillable());
    }

    public function test_author_relation()
    {   
        $author = new Author();
        $relation = $author->books();
        
        $this->assertInstanceOf(BelongsToMany::class, $relation);
        $this->assertEquals('author_books', $relation->getTable());
        $this->assertEquals('author_books.author_id', $relation->getQualifiedForeignPivotKeyName());
        $this->assertEquals('author_books.book_id', $relation->getQualifiedRelatedPivotKeyName());
    }
    
    public function test_properties_have_valid_values()
    {
        Author::unguard();
        $initial = [
            'name' => 'To Huu',
            'description' => 'abcd',
        ];
        $author = new Author($initial);
        $this->assertEquals($initial, $author->attributesToArray());
    }

    public function test_author_getter() {
        $author = new Author();
        $author->setAttribute('name', 'To Huu');
        $this->assertEquals('To Huu', $author->getAttributeValue('name'));
    }
}
