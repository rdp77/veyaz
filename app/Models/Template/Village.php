<?php

namespace App\Models\Template;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    use HasFactory;

    protected $table = 'indonesia_villages';

    protected $fillable = [
        'district_id',
        'name',
        'meta',
        'created_at',
        'updated_at',
    ];

    // public function Member()
    // {
    //     return $this->hasMany(Member::class, 'village', 'id');
    // }

    // public function User()
    // {
    //     return $this->hasMany(User::class, 'village', 'id');
    // }
}