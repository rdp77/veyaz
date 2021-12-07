<?php

namespace App\Models\Template;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $table = 'log';
    public $timestamps = false;

    protected $fillable = [
        'info',
        'u_id',
        'url',
        'user_agent',
        'ip',
        'added_at'
    ];
}