<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $categories = Category::factory(10)->create();
        $books = Book::factory(100)->create();
        $authors = Author::factory(20)->create();

        foreach ($books as $book) {
            $book->authors()->attach(
                $authors->random(rand(1, 5))->pluck('id')->toArray()
                //$authors->random()->id
            );
        }
    }
}
