<?php

namespace App\Models\Template;

use Illuminate\Database\Eloquent\Model;

class ActivityType extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'activity_type';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * Get the Activity List for the Activity Type.
     */
    public function activityList()
    {
        return $this->hasMany(ActivityList::class, 'type_id');
    }
}