<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Roles extends Model
{
    use HasFactory, SoftDeletes;
    const ID = 'id';
	const NAME = 'name';
	const NOTES = 'notes';
	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';
	protected $table = 'roles';

    const ROLE_ADMIN = 1;
    const ROLE_EMPLOYEE = 2;
    const ROLE_SALES = 3;
    const ROLE_USER = 4;

	protected $casts = [
		self::ID => 'int'
	];

	protected $dates = [
		self::CREATED_AT,
		self::UPDATED_AT
	];

	protected $fillable = [
		self::NAME,
		self::NOTES
	];

	public function users()
	{
		return $this->hasMany(User::class);
	}

}
