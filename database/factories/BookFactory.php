<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Publisher;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $publishers = Publisher::all();

        $date = $this->faker->dateTimeBetween($startDate = '-15 years', $endDate = 'now');
        $dateFormat = $date->format('Y-m-d');

        return [
            'title' => $this->faker->catchPhrase,
            'description' => $this->faker->text($maxNbChars = 200),
            'image' => 'https://picsum.photos/200/300',
            'isbn' => $this->faker->unique()->isbn13,
            'publish_date' => $dateFormat,
            'page_count' => $this->faker->numberBetween($min = 80, $max = 1000),
            // 'publisher_id' => $this->faker->numberBetween($min = 1, $max = count($publishers)),
        ];
    }
}
