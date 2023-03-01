<?php

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
        \DB::table('categories')->insert([
            [
                'name' => 'Bahasa',
                'category_id' => null,
            ],
            [
                'name' => 'Budaya',
                'category_id' => null,
            ],
            [
                'name' => 'Social',
                'category_id' => null,
            ],
            [
                'name' => 'Pengetahuan',
                'category_id' => null,
            ],
            [
                'name' => 'Bahasa Indonesia',
                'category_id' => 1,
            ],
            [
                'name' => 'Bahasa Inggris',
                'category_id' => 1,
            ],
            [
                'name' => 'Bahasa Sunda',
                'category_id' => 1,
            ],
            [
                'name' => 'Budaya Indonesia',
                'category_id' => 1,
            ],
            [
                'name' => 'Budaya Inggris',
                'category_id' => 1,
            ],
            [
                'name' => 'Part Of Speech',
                'category_id' => 6,
            ],
            [
                'name' => 'Tenses',
                'category_id' => 6,
            ]
        ]);
    }
}
