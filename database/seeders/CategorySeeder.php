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
        $category1 = new Category();
        $category1->name = 'Fiction';
        $category1->save();
        $category2 = new Category();
        $category2->name = 'Non-fiction';
        $category2->save();

    }
}
