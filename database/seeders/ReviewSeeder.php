<?php
# @Date:   2021-01-23T13:19:49+00:00
# @Last modified time: 2021-01-23T13:29:42+00:00




namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $review = new Review();
      $review->title = 'Amazing Read!';
      $review->body = 'So interesting, I was on the edge of my seat';
      $review->user_id = 1;
      $review->book_id = 2;
      $review->save();

      $review = new Review();
      $review->title = 'Boring';
      $review->body = 'Dull material, not very engaging';
      $review->user_id = 2;
      $review->book_id = 3;
      $review->save();

    }
}
