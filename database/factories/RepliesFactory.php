<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Comment;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Replies>
 */
class RepliesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userIds = User::pluck('id')->toArray();
        $commentIds = Comment::pluck('id')->toArray();
        return [
            'body' => $this->faker->text(50),
            'user_id' => $this->faker->randomElement($userIds),
            'comment_id' => $this->faker->randomElement($commentIds),
        ];
    }
}
