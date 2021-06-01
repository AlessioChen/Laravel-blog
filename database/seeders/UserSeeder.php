<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //ADMIN
        $user = new User();
        $user->name = 'Admin';
        $user->email = 'admin@admin.it';
        $user->password = Hash::make('password');

        $user->save();

        User::factory()->count(10)->create();

    }
}
