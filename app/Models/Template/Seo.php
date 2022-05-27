<?php

namespace App\Models\Template;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    use HasFactory;

    protected $table = 'seo';
    public $timestamps = false;

    protected $casts = [
        'active' => 'boolean',
    ];

    protected $fillable = [
        'name',
        'value'
    ];
}