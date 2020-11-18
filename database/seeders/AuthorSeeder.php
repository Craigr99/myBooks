<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $author = new Author();
        $author->f_name = 'Jack ';
        $author->l_name = 'Fairweather';
        $author->about = 'A longtime foreign correspondent for the Daily Telegraph and the Washington Post, Jack Fairweather is currently Middle East editor and correspondent for Bloomberg News. He lives in Istanbul, Turkey.';
        $author->save();

        $author = new Author();
        $author->f_name = 'Sara';
        $author->l_name = 'Collins';
        $author->about = 'ara Collins is of Jamaican descent and worked as a lawyer for seventeen years in Cayman, before admitting that what she really wanted to do was write novels. She studied Creative Writing at Cambridge University,';
        $author->save();

    }
}
