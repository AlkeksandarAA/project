<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Blogs;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userIds = User::pluck('id')->toArray();
        $blogIds = Blogs::pluck('id')->toArray();


        return [
            'body' => $this->faker->text(50),
            'user_id' => $this->faker->randomElement($userIds),
            'blog_id' => $this->faker->randomElement($blogIds),
        ];
    }
}
