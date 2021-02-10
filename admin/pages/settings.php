<?php


if (!class_exists('CodeLighterSettings')) {
    /**
     * Class CodeLighterSettings
     */
    class CodeLighterSettings
    {
        /**
         * CodeLighterSettings constructor.
         */
        public function __construct()
        {
            add_action('admin_menu', [$this, 'addMenu']);
            add_action('admin_init', [$this, 'registerSettings']);
        }

        /**
         * Code Lighter Menus
         */
        public function addMenu()
        {
            add_menu_page(
                __("Code Lighter", 'code-lighter'),
                __("Code Lighter", 'code-lighter'),
                'manage_options',
                'code-lighter',
                [$this, 'codeLighterHTML'],
                'dashicons-embed-generic',
                6
            );
        }

        /**
         * Code Lighter HTML
         */
        public function codeLighterHTML()
        {
            ?>
            <form action="options.php" method="post">
                <?php
                settings_fields('codeLighterSettings');
                do_settings_sections('codeLighterSettings');
                submit_button();
                ?>
            </form>
            <?php

        }

        /**
         * Code Lighter Setting Registration
         */
        public function registerSettings()
        {
            register_setting('codeLighterSettings', 'code_lighter_setting');
            add_settings_section(
                'code_lighter_section',
                __('Code Lighter Settings', 'code-lighter'),
                [$this, 'code_lighter_section_callback'],
                'codeLighterSettings'
            );


            add_settings_field(
                'code_lighter_style_field',
                __('Current CSS Style', 'code-lighter'),
                [$this, 'current_field_cb'],
                'codeLighterSettings',
                'code_lighter_section'
            );
        }

        public function current_field_cb()
        {
            $code_lighter_setting = get_option('code_lighter_setting');

            ?>
            <select name="code_lighter_setting[style]">
                <?php
                foreach ($this->getFileList() as $file) {
                    echo '<option 
                        value="' . sanitize_text_field($file['file']) . '" 
                        ' . $this->isSelected($code_lighter_setting['style'], $file['file']) . '
                        >
                        ' . $file['name'] . '
                        </option>';
                }
                ?>
            </select>
            <?php
        }

        public function code_lighter_section_callback()
        {
            //
        }

        /**
         * @param $checkOption
         * @param $currentValue
         * @return string
         */
        final protected function isSelected($checkOption, $currentValue): string
        {
            return $checkOption == $currentValue ? "selected='selected'" : '';
        }

        /**
         * generate file list from css path
         *
         * @return array
         */
        final protected function getFileList(): array
        {
            $dir = ABSPATH . 'wp-content/plugins/code-lighter/assets/css/highlight';

            $files = array_map(function ($file) {
                return [
                    'name' => $this->generateName($file),
                    'file' => $file
                ];
            }, scandir($dir));

            return array_filter($files, function ($file) {
                return !in_array($file['file'], ['.', '..']);
            });
        }

        /**
         * generate file name from file
         *
         * @param string $fileName
         * @return string|null
         */
        final private function generateName(string $fileName): ?string
        {
            $fileName = chop($fileName, '.css');
            return strtoupper(implode(" ", explode('-', $fileName)));
        }
    }

    $adminClass = new CodeLighterSettings();
}