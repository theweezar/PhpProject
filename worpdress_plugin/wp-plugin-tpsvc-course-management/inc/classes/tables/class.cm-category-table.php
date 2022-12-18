<?php

/**
 * Define table name and its column name
 */
class CM_Category_Table {
    public static $category_id = 'category_id';
    public static $parent_category_id = 'parent_category_id';
    public static $category_path = 'category_path';
    public static $created_at = 'created_at';

    public static function table_name() {
        global $wpdb;
        return $wpdb->prefix . 'category';
    }
}