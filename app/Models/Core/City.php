<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'indonesia_cities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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
