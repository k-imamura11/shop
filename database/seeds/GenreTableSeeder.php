<?php

use Illuminate\Database\Seeder;

class GenreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('genre')->insert([
          'genre_name' => 'メンズファッション',
        ]);
      DB::table('genre')->insert([
          'genre_name' => 'レディースファッション',
        ]);
      DB::table('genre')->insert([
          'genre_name' => 'キッズ・ベビー',
        ]);
      DB::table('genre')->insert([
          'genre_name' => '時計・アクセサリー',
        ]);

    }
}
