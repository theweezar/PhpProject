<?php

class Resource {
    /**
     * Require all the resource file to execute assign content $GLOBALS
     */
    public static function load_context() {
        $locale = Custom_Locale::get_current_locale();
        $context_path = get_template_directory() . '/locales/' . $locale;

        setcookie('lang', $locale, time() + (86400 * 30), '/');

        $directory = new RecursiveDirectoryIterator($context_path);
        $iterator = new RecursiveIteratorIterator($directory);
        $regex = new RegexIterator($iterator, '/^.+\.php$/i', RecursiveRegexIterator::GET_MATCH);

        foreach($regex as $php_file) {
            require_once($php_file[0]);
        }
    }

    /**
     * Get content from the $GLOBALS
     * 
     * @return string The locale string or the text_id
     */
    public static function text($text_id = '', $context = '') {
        $global_context_resource_array = 'context_resource_' . $context;
        $global_context_resource = $GLOBALS[$global_context_resource_array];
        return $global_context_resource[$text_id] ?? $text_id;
    }
}
