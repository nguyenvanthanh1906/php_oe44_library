<?php

namespace Database\Factories;

use App\Models\Puplisher;
use Illuminate\Database\Eloquent\Factories\Factory;

class PuplisherFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Puplisher::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'name' => $this->faker->text(12),
        ];
    }
}
