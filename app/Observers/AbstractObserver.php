<?php

namespace App\Observers;

use App\Models\Core\ActivityList;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class AbstractObserver
{
    /**
     * Get status Activity.
     *
     * @param  int  $type
     * @param  bool  $custom
     * @param  string  $message
     * @return string
     */
    protected function getStatus(int $type, bool $custom = false, $message = null): ?string
    {
        return $custom ? $message : ActivityList::find($type)->name;
    }

    /**
     * Store a new log.
     *
     * @param  string  $header
     * @param  string  $ip
     * @param  string  $action
     * @param  bool  $withPerformedOn
     * @param  Model  $performedOn
     * @return \Spatie\Activitylog\Contracts\Activity
     */
    public function createLog(string $header, string $ip, string $action, $withPerformedOn = false, $performedOn = null): \Spatie\Activitylog\Contracts\Activity
    {
        if ($withPerformedOn) {
            return activity()
                ->causedBy(Auth::user()->id)
                ->performedOn($performedOn)
                ->withProperties([
                    'url' => URL::full(),
                    'ip' => $ip,
                    'user_agent' => $header,
                ])
                ->log($action);
        } else {
            return activity()
                ->causedBy(Auth::user()->id)
                ->withProperties([
                    'url' => URL::full(),
                    'ip' => $ip,
                    'user_agent' => $header,
                ])
                ->log($action);
        }
    }
}
