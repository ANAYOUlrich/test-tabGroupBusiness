<?php
namespace App\Utils;

use App\Models\PermissionRole;
use App\Models\PermissionUser;

class Helper
{
    public static function existPermissionRole($permission_id, $role_id) {
        return PermissionRole::where('permission_id', $permission_id)
        ->where('role_id', $role_id)->exists();
    }   

    public static function existPermissionUser($permission_id, $user_id) {
        return PermissionUser::where('permission_id', $permission_id)
        ->where('user_id', $user_id)->exists();
    }

    public static function generalPolicie( $user, $action){
        $exist = self::generalPolicieBool($user, $action);

        if (!$exist) { abort(403);}

        return $exist;
    }

    public static function generalPolicieBool($user, $action){
        $exist = false;

        foreach ($user->permissions as $permission) {
            if($permission->libelle==$action){
                $exist = true;
            }
        }

        return $exist;
    }
}
?>
