<?php

namespace Database\Seeders;

use App\Models\Publisher;
use Illuminate\Database\Seeder;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $publisher = new Publisher();
        // $publisher->name = 'Big Books Inc';
        // $publisher->location = 'Dublin, Ireland';
        // $publisher->save();

        // $publisher = new Publisher();
        // $publisher->name = "O'Reilly Media";
        // $publisher->location = "Sebastopol, CA, USA";
        // $publisher->save();

        // $publisher = new Publisher();
        // $publisher->name = "Wrox Press";
        // $publisher->location = "Birmingham, UK";
        // $publisher->save();

        // $publisher = new Publisher();
        // $publisher->name = "New Riders";
        // $publisher->location = "Berkeley, CA, USA";
        // $publisher->save();

        // $publisher = new Publisher();
        // $publisher->name = "John Wiley";
        // $publisher->location = "Chichester, UK";
        // $publisher->save();

        for ($i = 1; $i <= 10; $i++) {
            Publisher::factory()->hasBooks(mt_rand(1, 15))->create();
        }
    }
}
