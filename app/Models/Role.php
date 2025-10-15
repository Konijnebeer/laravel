<?php

namespace App\Models;

use App\UserPermission;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name',
        'permission',
    ];
    protected array $cast = [
        'permission' => UserPermission::class,
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

}
