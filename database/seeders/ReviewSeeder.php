<?php
# @Date:   2021-01-23T13:19:49+00:00
# @Last modified time: 2021-01-23T13:29:42+00:00

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = Book::all();
        $book = Book::first();
        $users = User::all();

        $review = new Review();
        $review->title = 'Amazing Read!';
        $review->body = 'So interesting, I was on the edge of my seat';
        $review->user_id = 2;
        $review->book_id = $book->id;
        $review->rating = 4;
        $review->save();

        $review = new Review();
        $review->title = 'Boring';
        $review->body = 'Dull material, not very engaging';
        $review->user_id = 2;
        $review->book_id = $book->id;
        $review->rating = 3;
        $review->save();

        $review = new Review();
        $review->title = 'Good book ';
        $review->body = 'I liked it';
        $review->user_id = 5;
        $review->book_id = $book->id;
        $review->rating = 5;
        $review->save();

        // for ($i = 1; $i <= 10; $i++) {
        //     $review = Review::factory()->create();
        //     $review->save();
        // }

    }
}
