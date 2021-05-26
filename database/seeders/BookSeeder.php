<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Status;
use App\Models\Puplisher;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   $puplishers = (new Puplisher)->factory(5)->create();
        $statuses = (new Status)->factory(5)->create();
        foreach($puplishers as $puplisher)
        {
            foreach($statuses as $status)
            {
                (new Book)->factory(5)
                ->for($puplisher)
                ->for($status)
                ->create();
            }
        }
        
    }
}
