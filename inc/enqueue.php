<?php

if (function_exists('code_lighter_enqueue'))
    return;

function code_lighter_enqueue(): void
{
    //style
    wp_register_style(
        'code-lighter-highlight-style',
        plugins_url('/assets/css/highlight/monokai.css', CODE_LIGHTER_PLUGIN_URL),
        '',
        '',
        'all'
    );

    wp_register_style(
        'code-lighter-main-style',
        plugins_url('/assets/css/main.css', CODE_LIGHTER_PLUGIN_URL),
        '',
        '',
        'all'
    );

    wp_enqueue_style('code-lighter-highlight-style');
    wp_enqueue_style('code-lighter-main-style');

    //script
    wp_register_script(
        'code_lighter_highlight_script',
        plugins_url('/assets/js/highlight.js', CODE_LIGHTER_PLUGIN_URL),
        ['jquery'],
        '',
        true
    );

    wp_enqueue_script('code_lighter_highlight_script');

    wp_register_script(
        'code_lighter_main_script',
        plugins_url('/assets/js/main.js', CODE_LIGHTER_PLUGIN_URL),
        ['code_lighter_highlight_script'],
        '',
        true
    );

    wp_enqueue_script('code_lighter_main_script');
}