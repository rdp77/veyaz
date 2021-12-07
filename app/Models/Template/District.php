<?php

namespace App\Models\Template;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $table = 'indonesia_districts';

    protected $fillable = [
        'city_id',
        'name',
        'meta',
        'created_at',
        'updated_at',
    ];

    // public function Member()
    // {
    //     return $this->hasMany(Member::class, 'district', 'id');
    // }

    // public function City()
    // {
    //     return $this->hasMany(City::class, 'district', 'id');
    // }
}