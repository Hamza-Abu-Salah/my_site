<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Ali Al-qrinawi',
            'email' => 'alialqrinawi2@gmail.com',
            'password' => bcrypt('123qwe**'),
        ]);
    }
}
