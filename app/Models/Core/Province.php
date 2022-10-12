<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'indonesia_provinces';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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
