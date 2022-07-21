<?php

namespace App\Http\Controllers;

use App\Models\Template\ActivityList;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Get status Activity.
     *
     * @param  integer $type
     * @param  boolean $custom
     * @param  string $message
     * @return string
     */
    protected function getStatus($type, $custom = false, $message = null)
    {
        return $custom ? $message : ActivityList::find($type)->name;
    }

    /**
     * Store a new log.
     *
     * @param  string $header
     * @param  string $ip
     * @param  string $action
     * @param  boolean $withPerformedOn
     * @param  \Illuminate\Database\Eloquent\Model $performedOn
     * @return \Illuminate\Http\Response
     */
    public function createLog($header, $ip, $action, $withPerformedOn = false, $performedOn = null)
    {
        if ($withPerformedOn) {
            activity()
                ->causedBy(Auth::user()->id)
                ->performedOn($performedOn)
                ->withProperties([
                    'url' => URL::full(),
                    'ip' => $ip,
                    'user_agent' => $header
                ])
                ->log($action);
        } else {
            activity()
                ->causedBy(Auth::user()->id)
                ->withProperties([
                    'url' => URL::full(),
                    'ip' => $ip,
                    'user_agent' => $header
                ])
                ->log($action);
        }
    }
}