<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Retrieve the two users (admin and regular user)
        $adminUser = User::where('is_admin', 1)->first();
        $regularUser = User::where('is_admin', 0)->first();

        // Retrieve all posts
        $posts = Post::all();

        // Prepare sample comments for each user
        $commentsData = [
            [
                'content' => 'Great post! I learned a lot about Laravel.',
            ],
            [
                'content' => 'Very helpful, thank you for sharing this.',
            ],
            [
                'content' => 'Looking forward to more content like this!',
            ],
            [
                'content' => 'This explanation of Blade templates is fantastic.',
            ],
            [
                'content' => 'The information on middleware is really useful.',
            ],
        ];

        // Loop through each post and assign random comments to it
        foreach ($posts as $post) {
            foreach ($commentsData as $data) {
                Comment::create([
                    'content' => $data['content'],
                    'post_id' => $post->id,
                    'user_id' => (rand(0, 1) == 1 ? $adminUser->id : $regularUser->id), // Randomly assign admin or regular user
                    'is_deleted' => 0,
                    'date_created' => now(),
                ]);
            }
        }
    }
}
