<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Content;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition()
    {
        // Obtenemos una contenidos y usuarios aleatoriamente y que esté publicada
        $users = User::select('id')->where('role', 'USER')->get();
        $user = $users->random(1)->first();
        $contents = Content::select('id')->where('status', 'PUBLISHED')->get();
        $content = $contents->random(1)->first();

        return [
            'text' => $this->faker->paragraph,
            'sending_date' => rand(20240101, intval(date('Ymd'))),
            'publication_date' => rand(20240101, intval(date('Ymd'))),
            'status' => $this->faker->randomElement(['PENDING', 'PUBLISHED']),
            'content_id' => $content->id,
            'user_id' => $user->id,
            'created_by' => 'factory'
        ];
    }

}
