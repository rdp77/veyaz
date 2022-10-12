<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'indonesia_districts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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
