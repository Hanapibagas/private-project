<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'alamat' => 'jln.dumy',
            'roles' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        User::create([
            'name' => 'owener',
            'alamat' => 'jln.dumy',
            'roles' => 'owner',
            'email' => 'owener@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        User::create([
            'name' => 'hanapi',
            'roles' => 'user',
            'alamat' => 'jln.dumy',
            'email' => 'hanapi@gmail.com',
            'password' => bcrypt('12345678')
        ]);
    }
}
