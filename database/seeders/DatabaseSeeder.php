<?php
# @Date:   2021-01-18T10:09:11+00:00
# @Last modified time: 2021-01-23T13:20:13+00:00




namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AuthorSeeder::class);
        $this->call(PublisherSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(BookSeeder::class);
        $this->call(ReviewSeeder::class);
    }
}
