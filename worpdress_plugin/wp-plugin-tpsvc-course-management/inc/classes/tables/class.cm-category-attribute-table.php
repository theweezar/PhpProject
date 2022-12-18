<?php

class CM_Category_Attribute_Table {
    public static $locale = 'locale';
    public static $category_id = 'category_id';
    public static $category_name = 'category_name';

    public static function table_name() {
        global $wpdb;
        return $wpdb->prefix . 'category_attribute';
    }
}