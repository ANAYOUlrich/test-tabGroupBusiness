<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PermissionUser;

class PermissionUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PermissionUser::create([ 'user_id' =>  1, 'permission_id' =>  1]);
        PermissionUser::create([ 'user_id' =>  1, 'permission_id' =>  2]);
        PermissionUser::create([ 'user_id' =>  1, 'permission_id' =>  3]);
        //Editer
        PermissionUser::create([ 'user_id' =>  2, 'permission_id' =>  2]);
    }
}
