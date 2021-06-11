<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\CRequest;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CRequestTest extends TestCase
{
    public function test_contains_valid_fillable_properties()
    {
        $crequest = new CRequest();

        $this->assertEquals(['book_id', 'user_id', 'borrow_day', 'return_day', 'is_approve',], $crequest->getFillable());
    }

    public function test_crequest_book_relation()
    {   
        $crequest = new Crequest();
        $relation = $crequest->book();
        
        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('book_id', $relation->getForeignKeyName());
        $this->assertEquals('id', $relation->getOwnerKeyName());
    }

    public function test_crequest_user_relation()
    {   
        $crequest = new Crequest();
        $relation = $crequest->user();
        
        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('user_id', $relation->getForeignKeyName());
        $this->assertEquals('id', $relation->getOwnerKeyName());
    }

    public function test_properties_have_valid_values()
    {
        CRequest::unguard();
        $initial = [
            'book_id' => 1,
            'user_id' => 2,
            'borrow_day' => '2021-06-11',
            'return_day' => '2021-06-19',
            'is_approve' => false,
        ];
        $crequest = new CRequest($initial);
        $this->assertEquals($initial, $crequest->attributesToArray());
    }

    public function test_crequest_getter() {
        $crequest = new CRequest();
        $crequest->setAttribute('book_id', 1);
        $this->assertEquals(1, $crequest->getAttributeValue('book_id'));
    }
}
