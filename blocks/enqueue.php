<?php

if (!function_exists('code_lighter_block_block_init')) {
    function code_lighter_block_block_init()
    {
        wp_register_script(
            'code-lighter-block-script',
            plugins_url('/blocks/dist/bundle.js', CODE_LIGHTER_PLUGIN_URL),
            ['wp-i18n', 'wp-element', 'wp-blocks', 'wp-components', 'wp-editor', 'wp-api'],
            filemtime(plugin_dir_path(CODE_LIGHTER_PLUGIN_URL) . '/blocks/dist/bundle.js')
        );

        wp_register_style(
            'code_lighter_blocks_main',
            plugins_url('/blocks/dist/blocks-main.css', CODE_LIGHTER_PLUGIN_URL)
        );

        register_block_type('code-lighter/highlighter', array(
            'editor_script' => 'code-lighter-block-script',
            'editor_style' => 'code_lighter_blocks_main',
        ));
    }
}