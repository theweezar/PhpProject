<?php

class CM_Format_Helper {
    /**
     * Format the money by adding the dot symbol between every 3 number
     * 
     * @param string The money string and it should be numeric string
     * 
     * @return null|string Return null if the money string doesn't match the condition
     */
    public static function format_money($money_str = '') {
        if (!is_numeric($money_str)) return null;

        if (strlen($money_str) <= 3) return $money_str;

        $rev = strrev($money_str);

        $replace_money_str = preg_replace_callback('/(\d){3}/', function ($matches) {
            return $matches[0]. '.';
        }, $rev);

        return strrev($replace_money_str) . 'đ';
    }
}