<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Review::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $books = Book::all();
        $users = User::all();

        return [
            'title' => $this->faker->catchPhrase,
            'body' => $this->faker->text(200),
            'book_id' => $this->faker->numberBetween($min = 1, $max = count($books)),
            'user_id' => $this->faker->numberBetween($min = 1, $max = count($users)),
        ];
    }
}
