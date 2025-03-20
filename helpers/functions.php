<?php
function dd($data)
{
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    die();
}


if (!function_exists('asset')) {
    function asset($path)
    {
        // Return a relative path under /public
        // e.g., asset('css/style.css') => /public/css/style.css
        return '/public/' . ltrim($path, '/');
    }
}