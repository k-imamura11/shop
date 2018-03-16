<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
          'name' => 'admin',
          'email' => 'admin@gmail.com',
          'password' => bcrypt('qwer2535'),
          'address' => '神奈川県横浜市',
        ]);

      factory(App\User::class, 150)-> create();
    }
}
