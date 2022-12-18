<?php

class CM_Course_Helper {
    /**
     * Validate the date string is a valid date type
     * 
     * @param string $date_str Input a date string
     * 
     * @return bool Return true if the input date is a valid date type
     */
    public static function is_date($date_str) {
        if (!isset($date_str) || strcmp($date_str, '') === 0 || !date_parse($date_str)) return false;

        return true;
    }
    /**
     * Validate 4 import date fields in course form
     * 
     * @param string $start_register_date Start register date
     * @param string $end_register_date End register date
     * @param string $start_date Start learning date
     * @param string $end_date End learning date
     * 
     * @return bool Return true if all fields is valid
     */
    public static function is_validate_date_fields(
        $start_register_date,
        $end_register_date,
        $start_date,
        $end_date
    ) {
        if (
            !CM_Course_Helper::is_date($start_register_date)
            || !CM_Course_Helper::is_date($end_register_date)
            || !CM_Course_Helper::is_date($start_date)
            || !CM_Course_Helper::is_date($end_date)
        ) return false;

        $is_valid_register_date = $start_register_date <= $end_register_date;

        $is_valid_learning_date = $start_date <= $end_date;

        $is_valid_compare_register_date_to_learing_date = $start_register_date < $start_date && $end_register_date < $start_date;

        return $is_valid_register_date
            && $is_valid_learning_date
            && $is_valid_compare_register_date_to_learing_date;
    }
}