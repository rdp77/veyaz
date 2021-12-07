<?php

namespace App\Models\Template;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $table = 'indonesia_provinces';

    protected $fillable = [
        'name',
        'meta',
        'created_at',
        'updated_at',
    ];

    // public function Member()
    // {
    //     return $this->hasMany(Member::class, 'province', 'id');
    // }

    // public function User()
    // {
    //     return $this->hasMany(User::class, 'province', 'id');
    // }
}