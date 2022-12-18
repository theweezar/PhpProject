<?php

class Custom_Locale {
    /**
     * The default locale
     */
    public static $default_locale = 'vi';

    /**
     * The locales array
     */
    public static $locales = array(
        'vi' => 'Viet Nam',
        'en' => 'English'
    );

    /**
     * Get the current locale
     * 
     * @return string The current locale ID
     */
    public static function get_current_locale() {
        $lang =  Custom_Locale::$default_locale;

        if (isset($_GET['lang']) && gettype($_GET['lang']) === 'string' && array_key_exists($lang, Custom_Locale::$locales)) {
            $lang = $_GET['lang'];
        } else if (isset($_COOKIE['lang'])) {
            $lang = $_COOKIE['lang'];
        }

        return $lang;
    }

    /**
     * Check whether the input locale exists or not
     * 
     * @return bool Return true if the provided locale exists
     */
    public static function is_exist($locale) {
        return isset(Custom_Locale::$locales[$locale]);
    }
}