<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostLastVersion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::truncate();
        PostLastVersion::truncate();
        for ($i=0; $i < 50; $i++) {
            Post::create([
                'title' => 'Post Title ' . $i,
                'content' => 'Post Content ' . $i,
            ]);

            PostLastVersion::create([
                'title' => 'Post Last Version Title ' . $i,
                'content' => 'Post Last Version Content ' . $i,
            ]);
        }
    }
}
