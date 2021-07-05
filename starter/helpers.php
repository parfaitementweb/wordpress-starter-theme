<?php

if (! function_exists('dd')) {
    function dd()
    {
        $args = func_get_args();
        call_user_func_array('dump', $args);
        die();
    }
}

if (! function_exists('isFirstArrayKey')) {
    function isFirstArrayKey($key, array $array)
    {
        reset($array);
        if ($key === key($array)) {
            return true;
        }

        return false;
    }
}

if (! function_exists('isLastArrayKey')) {
    function isLastArrayKey($key, array $array)
    {
        end($array);
        if ($key === key($array)) {
            return true;
        }

        return false;
    }
}


if (! function_exists('asset')) {
    function asset($path)
    {
        return get_template_directory_uri() . '/assets/' . ltrim($path, '/');;
    }
}