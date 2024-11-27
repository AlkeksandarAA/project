<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Event;

class GuestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $eventIds = Event::pluck('id')->toArray();

        for ($i = 0 ; $i < 10 ; $i++){
            DB::table('guests')->insert([
                'name' => $faker->name,
                'about' => $faker->text,
                'event_id' => $faker->randomElement($eventIds),
            ]);
        }
    }
}
