<?php

if (!function_exists('code_lighter_deactivate')) {
    function code_lighter_deactivate()
    {
        flush_rewrite_rules();
    }
}

