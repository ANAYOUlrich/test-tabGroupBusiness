<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    static $rules = [
		'libelle' => 'required',
    ];

    protected $perPage = 20;

    protected $fillable = ['libelle'];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function permissionRoles()
    {
        return $this->hasMany(PermissionRole::class);
    }

    public function permissionUsers()
    {
        return $this->hasMany(PermissionUser::class);
    }

}
