<?php

namespace Database\Seeders;

use App\Models\Todo;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Fake\Generator as Faker;

class TodosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('en_US');

        for( $i = 0; $i < 15; $i++ ) {
            $todo = new Todo();
            $todo->name = $faker->sentence(3);
            $todo->description = $faker->sentence(10);
            $todo->due_date = Carbon::now()->addDays(rand(1, 30));
            $todo->status = rand(0, 1);
            $todo->created_by = 1;
            $todo->updated_by = 1;
            $todo->timestamps = false;
            $todo->save();
        }

        // Todo::factory(10)->create();
    }
}
