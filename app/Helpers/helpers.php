<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

if (!function_exists('get_storage_image')) {

    function get_storage_image($path, $name, $type = 'normal')
    {
        $full_path = '/storage/' . $path . '/' . $name;
        if ($name) {
            return asset($full_path);
        }
    }
}


if (!function_exists('log_error')) {

    function log_error(\Exception $e)
    {
        Log::error($e->getMessage());
    }
}

if (!function_exists('getImage')) {
    function getImage($image = null, $type = null)
    {
        if ($image && Storage::disk('public')->exists($image)) {
            return Storage::disk('public')->url($image);
        } else {
            return asset('/images/default.png');
        }
    }
}

if (!function_exists('something_wrong_toast')) {

    function something_wrong_toast($message = null)
    {
        toastr()->error($message ?? 'Something is wrong!');
    }
}
