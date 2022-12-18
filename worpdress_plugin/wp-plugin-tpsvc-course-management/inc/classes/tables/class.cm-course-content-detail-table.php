<?php

class CM_Course_Content_Detail_Table {
    public static $locale = 'locale';
    public static $course_content_detail_id = 'course_content_detail_id';
    public static $course_content_detail_name = 'course_content_detail_name';
    public static $course_thumbnail_url = 'course_thumbnail_url';
    public static $short_description = 'short_description';
    public static $about_this_course = 'about_this_course';
    public static $what_you_will_learn = 'what_you_will_learn';
    public static $additional_content = 'additional_content';

    public static function table_name() {
        global $wpdb;
        return $wpdb->prefix . 'course_content_detail';
    }
}