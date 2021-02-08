<?php


if (!function_exists('code_lighter_activate')) {
    function code_lighter_activate()
    {
        flush_rewrite_rules();
    }
}
