<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = Book::all();

        $authors = Author::all();
        $categories = Category::all();

        foreach ($books as $book) {
            $book->categories()->attach(rand(1, count($categories)));
            $book->authors()->attach(rand(1, count($authors)));
        }

        // $publisher1 = Publisher::first();
        // $book = new Book();
        // $book->title = 'Fake book';
        // $book->description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin efficitur lacus sed purus interdum molestie. Sed urna eros, volutpat sed lorem non, finibus consequat dui';
        // $book->image = 'image.png';
        // $book->isbn = '12345678910';
        // $book->publish_date = '2020-01-20';
        // $book->page_count = '212';
        // $book->publisher_id = $publisher1->id;
        // $book->save();
    }
}
