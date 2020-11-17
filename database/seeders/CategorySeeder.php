<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category();
        $category->name = 'Fiction';
        $category->save();
        $category = new Category();
        $category->name = 'Non-fiction';
        $category->save();
        $category = new Category();
        $category->name = 'Biography';
        $category->save();
        $category = new Category();
        $category->name = 'Horror';
        $category->save();

    }
}
