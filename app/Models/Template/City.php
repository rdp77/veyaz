<?php

namespace App\Models\Template;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $table = 'indonesia_cities';

    protected $fillable = [
        'province_id',
        'name',
        'meta',
        'created_at',
        'updated_at',
    ];

    // public function Member()
    // {
    //     return $this->hasMany(Member::class, 'regency', 'id');
    // }

    // public function User()
    // {
    //     return $this->hasMany(User::class, 'regency', 'id');
    // }
}