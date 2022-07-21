<?php

namespace App\Models\Template;

use Illuminate\Database\Eloquent\Model;

class ActivityList extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'activity_list';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type_id'
    ];

    /**
     * Get the Activity Type that owns the Activity List.
     */
    public function activityType()
    {
        return $this->belongsTo(ActivityType::class, 'type_id');
    }
}