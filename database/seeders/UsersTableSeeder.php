<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email','admin@example.com')->first();

        if(!$user){
            User::create([
                'role' => 'admin',
                'name'=>'afnan',
                'email'=> 'admin@example.com',
                'password' => Hash::make('password'),

            ]);
        }
    }
}
