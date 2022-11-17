<?php

namespace App\Helpers;

use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Log\Logger;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

class SidebarHelper
{
    public static function setActive($routeName, $activeClass = 'active')
    {
        if (is_array($routeName)) {
            foreach ($routeName as $route) {
                if (Request::routeIs($route)) {
                    return $activeClass;
                }
            }
        }
        return Request::routeIs($routeName) ? $activeClass : '';
    }

}
