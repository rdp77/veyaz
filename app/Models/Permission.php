<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "permissions";
    protected $fillable = [
        'name', 'label', 'parent_id', 'guard_name'
    ];

    public function childs()
    {
        return $this->hasMany(Permission::class, 'parent_id', 'id');
    }
}
