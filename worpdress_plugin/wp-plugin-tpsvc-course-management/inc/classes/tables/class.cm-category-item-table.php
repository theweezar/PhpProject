<?php

class CM_Category_Item_Table {
    public static $category_id = 'category_id';
    public static $course_id = 'course_id';
    public static $master_category_id = 'master_category_id';

    public static function table_name() {
        global $wpdb;
        return $wpdb->prefix . 'category_item';
    }
}