<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PermissionRole;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //admin
        PermissionRole::create([ 'role_id' =>  1, 'permission_id' =>  1]);
        PermissionRole::create([ 'role_id' =>  1, 'permission_id' =>  2]);
        PermissionRole::create([ 'role_id' =>  1, 'permission_id' =>  3]);
        //Editer
        PermissionRole::create([ 'role_id' =>  2, 'permission_id' =>  2]);
    }
}
