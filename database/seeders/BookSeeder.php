<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Publisher;
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
        $publisher1 = Publisher::first();

        $book = new Book();
        $book->title = 'Fake book';
        $book->description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin efficitur lacus sed purus interdum molestie. Sed urna eros, volutpat sed lorem non, finibus consequat dui';
        $book->image = 'image.png';
        $book->isbn = '12345678910';
        $book->publish_date = '2020-01-20';
        $book->page_count = '212';
        $book->publisher_id = $publisher1->id;
        $book->save();

    }
}
