<?php

class CM_Database {

    public function __construct() {
        $this->initialize_table();
    }

    public function initialize_table() {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();

        if (!function_exists('dbDelta')) {
            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        }

        $create_student_table = '
        CREATE TABLE IF NOT EXISTS '.CM_Student_Table::table_name().' (
            '.CM_Student_Table::$student_id.' VARCHAR(50) NOT NULL,
            '.CM_Student_Table::$email.' VARCHAR(100) NOT NULL,
            '.CM_Student_Table::$student_password.' VARCHAR(255) NOT NULL,
            '.CM_Student_Table::$first_name.' VARCHAR(50) NOT NULL,
            '.CM_Student_Table::$last_name.' VARCHAR(50) NOT NULL,
            '.CM_Student_Table::$gender.' BIT,
            '.CM_Student_Table::$birth_day.' DATE NOT NULL,
            '.CM_Student_Table::$phone_number.' VARCHAR(15) NOT NULL,
            '.CM_Student_Table::$address.' VARCHAR(100),
            '.CM_Student_Table::$citizen_identification.' VARCHAR(20) NOT NULL,
            '.CM_Student_Table::$created_at.' DATETIME NOT NULL,
            PRIMARY KEY  ('.CM_Student_Table::$student_id.')
        ) '.$charset_collate.'
        ';

        $create_course_table = '
        CREATE TABLE IF NOT EXISTS '.CM_Course_Table::table_name().' (
            '.CM_Course_Table::$course_id.' VARCHAR(100) NOT NULL,
            '.CM_Course_Table::$course_name.' VARCHAR(100) NOT NULL,
            '.CM_Course_Table::$price.' INT NOT NULL,
            '.CM_Course_Table::$discount_price.' INT,
            '.CM_Course_Table::$number_of_student.' INT NOT NULL,
            '.CM_Course_Table::$start_register_date.' DATE NOT NULL,
            '.CM_Course_Table::$end_register_date.' DATE NOT NULL,
            '.CM_Course_Table::$start_date.' DATE NOT NULL,
            '.CM_Course_Table::$end_date.' DATE NOT NULL,
            '.CM_Course_Table::$level.' INT,
            '.CM_Course_Table::$course_content_detail_id.' VARCHAR(100),
            '.CM_Course_Table::$instructor_name.' VARCHAR(100) NOT NULL,
            '.CM_Course_Table::$created_at.' DATETIME NOT NULL,
            PRIMARY KEY  ('.CM_Course_Table::$course_id.')
        ) '.$charset_collate.'
        ';

        $create_course_content_detail_table = '
        CREATE TABLE IF NOT EXISTS '.CM_Course_Content_Detail_Table::table_name().' (
            '.CM_Course_Content_Detail_Table::$locale.' VARCHAR(5) NOT NULL,
            '.CM_Course_Content_Detail_Table::$course_content_detail_id.' VARCHAR(100) NOT NULL,
            '.CM_Course_Content_Detail_Table::$course_thumbnail_url.' VARCHAR(255),
            '.CM_Course_Content_Detail_Table::$short_description.' TEXT,
            '.CM_Course_Content_Detail_Table::$about_this_course.' TEXT,
            '.CM_Course_Content_Detail_Table::$what_you_will_learn.' TEXT,
            '.CM_Course_Content_Detail_Table::$additional_content.' TEXT,
            PRIMARY KEY  ('.CM_Course_Content_Detail_Table::$locale.', '.CM_Course_Content_Detail_Table::$course_content_detail_id.')
        ) '.$charset_collate.'
        ';

        $create_category_table = '
        CREATE TABLE IF NOT EXISTS '.CM_Category_Table::table_name().' (
            '.CM_Category_Table::$category_id.' VARCHAR(50) NOT NULL,
            '.CM_Category_Table::$parent_category_id.' VARCHAR(50),
            '.CM_Category_Table::$category_path.' VARCHAR(1024),
            '.CM_Category_Table::$created_at.' DATETIME,
            PRIMARY KEY  ('.CM_Category_Table::$category_id.')
        ) '.$charset_collate.'
        ';

        $create_category_item_table = '
        CREATE TABLE IF NOT EXISTS '.CM_Category_Item_Table::table_name().' (
            '.CM_Category_Item_Table::$category_id.' VARCHAR(50) NOT NULL,
            '.CM_Category_Item_Table::$course_id.' VARCHAR(100) NOT NULL,
            '.CM_Category_Item_Table::$master_category_id.' VARCHAR(50) NOT NULL,
            PRIMARY KEY  ('.CM_Category_Item_Table::$category_id.', '.CM_Category_Item_Table::$course_id.')
        ) '.$charset_collate.'
        ';

        $create_category_attribute_table = '
        CREATE TABLE IF NOT EXISTS '.CM_Category_Attribute_Table::table_name().' (
            '.CM_Category_Attribute_Table::$locale.' VARCHAR(5) NOT NULL,
            '.CM_Category_Attribute_Table::$category_id.' VARCHAR(50) NOT NULL,
            '.CM_Category_Attribute_Table::$category_name.' VARCHAR(100) NOT NULL,
            PRIMARY KEY  ('.CM_Category_Attribute_Table::$locale.', '.CM_Category_Attribute_Table::$category_id.')
        ) '.$charset_collate.'
        ';

        dbDelta($create_student_table);
        dbDelta($create_category_item_table);
        dbDelta($create_category_table);
        dbDelta($create_course_table);
        dbDelta($create_course_content_detail_table);
        dbDelta($create_category_attribute_table);
    }

    public static function get_simple_log() {
        global $wpdb;

        return array(
            'last_query' => $wpdb->last_query,
            'last_result' => $wpdb->last_result,
            'last_error' => $wpdb->last_error
        );
    }

    /**
     * Get the error message to know there is something wrong with database
     * 
     * @return string The error message
     */
    public static function get_last_error() {
        global $wpdb;
        return $wpdb->last_error;
    }
}