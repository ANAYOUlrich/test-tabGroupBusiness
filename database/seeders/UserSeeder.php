<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
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
        User::create([ 'name' => 'admin', 'email' => 'admin@gmail.com', 'password' =>  Hash::make('password'), 'role_id'=>1]);
        User::create([ 'name' => 'editer', 'email' => 'editer@gmail.com', 'password' =>  Hash::make('password'), 'role_id'=>2]);
        User::create([ 'name' => 'utilisateur', 'email' => 'utilisateur@gmail.com', 'password' =>  Hash::make('password'),'role_id'=>3]);
    }
}
