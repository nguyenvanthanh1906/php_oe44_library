<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{

    public function test_contains_valid_fillable_properties()
    {
        $user = new User();

        $this->assertEquals(['name','email','role_id','password',], $user->getFillable());
    }

    public function test_properties_have_valid_values()
    {
        User::unguard();
        $initial = [
            'name' => 'Nguyen Van Thanh',
            'email' => 'thanhnguyenvanpro123@gmail.com',
            'role_id' => 2,
            'password' => bcrypt('12345678'),
        ];
        $user = new User($initial);
        $user->setHidden(['password' => bcrypt('12345678')]);
        $this->assertEquals($initial,$user->attributesToArray());
    }

    public function test_user_getter() {
        $user = new User();
        $user->setAttribute('name', 'Nguyen Van Thanh');
        $this->assertEquals('Nguyen Van Thanh', $user->getAttributeValue('name'));
    }
}
