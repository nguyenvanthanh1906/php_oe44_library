<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Puplisher;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PuplisherTest extends TestCase
{
    public function test_contains_valid_fillable_properties()
    {
        $puplisher = new Puplisher();

        $this->assertEquals(['name'], $puplisher->getFillable());
    }

    public function test_puplisher_relation()
    {   
        $puplisher = new Puplisher();
        $relation = $puplisher->books();

        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('books.puplisher_id', $relation->getQualifiedForeignKeyName());
    }

    public function test_properties_have_valid_values()
    {
        Puplisher::unguard();
        $initial = [
            'name' => 'Kim Dong',
        ];
        $puplisher = new Puplisher($initial);
        $this->assertEquals($initial, $puplisher->attributesToArray());
    }

    public function test_puplisher_getter() {
        $puplisher = new Puplisher();
        $puplisher->setAttribute('name', 'Kim Dong');
        $this->assertEquals('Kim Dong', $puplisher->getAttributeValue('name'));
    }
}
