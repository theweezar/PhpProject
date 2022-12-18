<?php

/**
 * Define table name and its column name
 */
class CM_Course_Table {
    public static $course_id = 'course_id';
    public static $course_name = 'course_name';
    public static $price = 'price';
    public static $discount_price = 'discount_price';
    public static $number_of_student = 'number_of_student';
    public static $start_register_date = 'start_register_date';
    public static $end_register_date = 'end_register_date';
    public static $start_date = 'start_date';
    public static $end_date = 'end_date';
    public static $level = 'level';
    public static $course_content_detail_id = 'course_content_detail_id';
    public static $instructor_name = 'instructor_name';
    public static $created_at = 'created_at';

    public static function table_name() {
        global $wpdb;
        return $wpdb->prefix . 'course';
    }
}