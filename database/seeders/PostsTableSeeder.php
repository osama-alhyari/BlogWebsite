<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed multiple posts with HTML content for WYSIWYG display
        $posts = [
            [
                'title' => 'Exploring Laravel Basics',
                'subtitle' => 'Getting Started with Laravel',
                'content' => '<p>This is the <strong>first post</strong> about getting started with Laravel. Learn the basics and set up your environment.</p><p>Laravel is a powerful MVC PHP framework designed for developers who need a simple and elegant toolkit to create full-featured web applications.</p>',
                'date_created' => now(),
            ],
            [
                'title' => 'Understanding Eloquent Relationships',
                'subtitle' => 'Eloquent ORM Deep Dive',
                'content' => '<p>This post covers <em>one-to-many</em> and <em>many-to-many</em> relationships in Eloquent.</p><ul><li>One-to-One</li><li>One-to-Many</li><li>Many-to-Many</li></ul>',
                'date_created' => now(),
            ],
            [
                'title' => 'Mastering Blade Templates',
                'subtitle' => 'Laravel Blade Templating Engine',
                'content' => '<h2>Introduction to Blade</h2><p>Blade is the simple, yet powerful templating engine provided with Laravel. It allows you to create templates with dynamic content.</p>',
                'date_created' => now(),
            ],
            [
                'title' => 'Working with Middleware',
                'subtitle' => 'Advanced Routing and Middleware',
                'content' => '<p>Middleware provides a convenient mechanism for filtering HTTP requests entering your application. For example, Laravel includes a middleware that verifies the user of your application is authenticated.</p>',
                'date_created' => now(),
            ],
        ];

        // Insert each post into the database
        foreach ($posts as $postData) {
            Post::create($postData);
        }
    }
}
