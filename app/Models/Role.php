<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    static $rules = [
		'libelle' => 'required',
    ];

    protected $fillable = ['libelle'];

    protected $perPage = 20;


    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_roles');
    }

    public function permissionRoles()
    {
        return $this->hasMany(PermissionRole::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
