<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Status;
use App\Models\Puplisher;
use App\Models\Author;
use App\Models\Category;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $categoriesParent = (new Category)->factory(5)->create(['parent_id' => null]);
        foreach($categoriesParent as $parent)
        {
            (new Category)->factory(rand(1, 3))->create(['parent_id' => $parent->id]); 
        }
        
        $puplishers = (new Puplisher)->factory(3)->create();
        $statuses = (new Status)->factory(2)->create();
        $authors = (new Author)->factory(5)->create();
        for ($i = 1; $i < 101 ; $i++)
        {
            (new Book)->factory(1)
            ->for((new Puplisher)->all()->random(1)->first())
            ->for((new Status)->all()->random(1)->first())
            ->hasAttached((new Category)->all()->random(rand(1,2)))
            ->hasAttached((new Author)->all()->random(rand(1,2)))
            ->create();
        }
    }
}
