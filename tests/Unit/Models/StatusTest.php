<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Status;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StatusTest extends TestCase
{
    public function test_contains_valid_fillable_properties()
    {
        $status = new Status();

        $this->assertEquals(['name'], $status->getFillable());
    }

    public function test_status_relation()
    {   
        $status = new Status();
        $relation = $status->books();
        
        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('books.status_id', $relation->getQualifiedForeignKeyName());
    }

    public function test_properties_have_valid_values()
    {
        Status::unguard();
        $initial = [
            'name' => 'sold out',
        ];
        $status = new Status($initial);
        $this->assertEquals($initial, $status->attributesToArray());
    }

    public function test_status_getter() {
        $status = new Status();
        $status->setAttribute('name', 'sold out');
        $this->assertEquals('sold out', $status->getAttributeValue('name'));
    }
}
