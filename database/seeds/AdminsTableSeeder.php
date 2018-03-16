<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('admins')->insert([
          'name' => 'admin',
          'email' => 'admin@gmail.com',
          'password' => bcrypt('qwer2535'),
          'address' => '神奈川県横浜市',
        ]);

      factory(App\Admin::class, 150)-> create();
    }
}
