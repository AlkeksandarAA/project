<?php

namespace Database\Seeders;

use App\Models\Biography;
use App\Models\Blogs;
use App\Models\Comment;
use App\Models\Resume;
use App\Models\User;
use App\Models\Address;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\Post;
use App\Models\Role;

use App\Models\Replies;


use Faker\Factory as Faker;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\GuestSeeder;

class DatabaseSeeder extends Seeder
{

    
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::insert([
            ['role' => 'guest'],
            ['role' => 'admin'],
            ['role' => 'superAdmin'],
        ]);

        $faker = Faker::create();
        $users = User::factory(30)->create();
        $userIds = User::pluck('id')->toArray();

        
        foreach($users as $user){
        Address::factory(1)->create([
            'user_id' => $user->id,
        ]);
        Biography::factory(1)->create([
            'user_id' => $user->id,
        ]);
        Resume::factory(1)->create([
            'user_id' => $user->id,
        ]);
        Post::factory(2)->create([
            'user_id' => $user->id,
            'recommender_id' => $faker->randomElement($userIds),
        ]);
        }
       $events = Event::factory(50)->create();
        foreach($events as $event){
            Ticket::factory(1)->create(
                ['event_id' => $event->id],
            );
        }


        Blogs::factory(20)->create();

            Comment::factory(50)->create();
        Replies::factory(100)->create();
        $this->call(GuestSeeder::class);
    }
}
