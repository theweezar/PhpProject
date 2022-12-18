<?php

/**
 * Define table name and its column name
 */
class CM_Student_Table {
    public static $student_id = 'student_id';
    public static $email = 'email';
    public static $student_password = 'student_password';
    public static $first_name = 'first_name';
    public static $last_name = 'last_name';
    public static $gender = 'gender';
    public static $birth_day = 'birth_day';
    public static $phone_number = 'phone_number';
    public static $address = 'address';
    public static $citizen_identification = 'citizen_identification';
    public static $created_at = 'created_at';

    public static function table_name() {
        global $wpdb;
        return $wpdb->prefix . 'student';
    }
}