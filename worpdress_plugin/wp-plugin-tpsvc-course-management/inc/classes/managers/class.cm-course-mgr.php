<?php

class CM_Course_Mgr {
    /**
     * Check if the given column value exists
     * 
     * @param string $column_name The column name
     * @param string $value The column value
     * @return bool Return true if the give column value existed in database
     */
    public static function is_column_value_exist($column_name, $value) {
        global $wpdb;
        $stmt = $wpdb->prepare('
        SELECT * FROM ' . CM_Course_Table::table_name() . ' WHERE ' . $column_name . ' = %s
        ', array($value));
        $result = $wpdb->get_results($stmt, ARRAY_A);
        return count($result) !== 0;
    }

    /**
     * Get all courses in database
     * @return array The course array
     */
    public static function get_courses() {
        global $wpdb;
        $stmt = '
        SELECT * FROM ' . CM_Course_Table::table_name() . '
        ';
        $result = $wpdb->get_results($stmt, ARRAY_A);
        return $result;
    }

    /**
     * Get course by its ID
     * @param string $course_id The course ID
     * @return array The course array
     */
    public static function get_course_by_id($course_id) {
        global $wpdb;
        $stmt = $wpdb->prepare('
        SELECT * FROM ' . CM_Course_Table::table_name() . ' WHERE ' . CM_Course_Table::$course_id . ' = %s
        ', array($course_id));
        $result = $wpdb->get_results($stmt, ARRAY_A);
        return $result;
    }

    /**
     * Create course
     * @param array $course The course array
     * @return int|false The number of rows updated, or false on error.
     */
    public static function create_course($course = array()) {
        global $wpdb;
        return $wpdb->insert(CM_Course_Table::table_name(), $course);
    }

    /**
     * Update the course by course ID
     * @param array $course The course array
     * @param string $where The where sql string
     * @return int|false The number of rows updated, or false on error.
     */
    public static function update_course($course = array(), $where) {
        global $wpdb;
        return $wpdb->update(
            CM_Course_Table::table_name(),
            $course,
            $where
        );
    }

    /**
     * Delete the course based on its ID
     * @param string @course_id The course ID
     * @return int|false The number of rows updated, or false on error.
     */
    public static function delete_course($course_id) {
        global $wpdb;
        return $wpdb->delete(
            CM_Course_Table::table_name(),
            array(
                CM_Course_Table::$course_id => $course_id
            )
        );
    }

    /**
     * Get all course contents
     * @return array The course contents array
     */
    public static function get_course_contents() {
        global $wpdb;
        $stmt = '
        SELECT * FROM ' . CM_Course_Content_Detail_Table::table_name() .
        ' GROUP BY ' . CM_Course_Content_Detail_Table::$course_content_detail_id . '
        ';
        $result = $wpdb->get_results($stmt, ARRAY_A);
        return $result;
    }

    /**
     * Get course content by its ID
     * @param string $course_content_id The course content ID
     * @param string $locale The locale ID
     * @return array The course content
     */
    public static function get_course_content_by_id($course_content_id, $locale = '') {
        global $wpdb;

        $sql = '
        SELECT * FROM ' . CM_Course_Content_Detail_Table::table_name() . ' WHERE ' . 
        CM_Course_Content_Detail_Table::$course_content_detail_id . ' = %s
        ';

        if (strcmp($locale, '') !== 0) {
            $sql = $sql . ' AND ' . CM_Course_Content_Detail_Table::$locale . ' = %s';
        }

        $stmt = $wpdb->prepare($sql, array($course_content_id, $locale));
        $result = $wpdb->get_results($stmt, ARRAY_A);
        return $result;
    }

    /**
     * Determine if the course content exists by its ID
     * @param string $course_content_id Course content ID
     * @return bool Return True if the course content exists
     */
    public static function is_course_content_id_exist($course_content_id) {
        global $wpdb;
        $stmt = $wpdb->prepare('
        SELECT * FROM ' . CM_Course_Content_Detail_Table::table_name() . ' WHERE ' . 
        CM_Course_Content_Detail_Table::$course_content_detail_id . ' = %s
        ', array($course_content_id));
        $result = $wpdb->get_results($stmt, ARRAY_A);
        return count($result) !== 0;
    }

    /**
     * Create the course content
     * @param array $course_content_detail The course content array
     * @return int|false The number of rows inserted, or false on error.
     */
    public static function create_course_content_detail($course_content_detail = array()) {
        global $wpdb;
        return $wpdb->insert(CM_Course_Content_Detail_Table::table_name(), $course_content_detail);
    }

    /**
     * Update the course content detail by
     * 
     * @param array $course_content_detail The course content array
     * @param string $where The where sql string
     * @return int|false The number of rows updated, or false on error.
     */
    public static function update_course_content_detail($course_content_detail, $where) {
        global $wpdb;
        return $wpdb->update(
            CM_Course_Content_Detail_Table::table_name(),
            $course_content_detail,
            $where
        );
    }

    /**
     * Delete the course content
     * @param string @where The where sql string
     * @return int|false The number of rows updated, or false on error.
     */
    public static function delete_course_content_detail($where) {
        global $wpdb;
        return $wpdb->delete(
            CM_Course_Content_Detail_Table::table_name(),
            $where
        );
    }

    /**
     * Get all courses with content
     * 
     * @param string $locale The locale ID
     * @return array The course join course content array
     */
    public static function get_all_courses_with_content($locale = '') {
        global $wpdb;

        if (strcmp($locale, '') === 0) {
            $locale = Custom_Locale::$default_locale;
        }

        $stmt = $wpdb->prepare('
        SELECT * FROM ' . CM_Course_Table::table_name() . ' AS c JOIN ' . CM_Course_Content_Detail_Table::table_name() . ' AS ct 
        ON c.' . CM_Course_Table::$course_content_detail_id .' = ct.' . CM_Course_Content_Detail_Table::$course_content_detail_id . '
        WHERE ct.' . CM_Course_Content_Detail_Table::$locale . ' = %s
        ', array($locale));

        $result = $wpdb->get_results($stmt, ARRAY_A);
        return $result;
    }

    /**
     * Get course with content by course ID
     * 
     * @param string $course_id The course ID
     * @param string $locale The locale ID
     * @return array The course join course content array
     */
    public static function get_course_with_content($course_id, $locale = '') {
        global $wpdb;

        if (strcmp($locale, '') === 0) {
            $locale = Custom_Locale::$default_locale;
        }

        $stmt = $wpdb->prepare('
        SELECT * FROM ' . CM_Course_Table::table_name() . ' AS c JOIN ' . CM_Course_Content_Detail_Table::table_name() . ' AS ct 
        ON c.' . CM_Course_Table::$course_content_detail_id .' = ct.' . CM_Course_Content_Detail_Table::$course_content_detail_id . '
        WHERE c.' . CM_Course_Table::$course_id .' = %s AND ct.' . CM_Course_Content_Detail_Table::$locale . ' = %s
        ', array($course_id, $locale));

        $result = $wpdb->get_results($stmt, ARRAY_A);
        return $result;
    }

    /**
     * Get course with content by the ID list
     * @param array $list_course_id The course ID list
     * @param string $locale The locale value
     * @return array Return the course with content array
     */
    public static function get_courses_with_content_by_id_list($list_course_id = array(), $locale = '') {
        global $wpdb;
        $place_holders = implode(', ', array_fill(0, count($list_course_id), '%s'));

        if (strcmp($locale, '') === 0) {
            $locale = Custom_Locale::$default_locale;
        }

        array_push($list_course_id, $locale);
        
        $stmt = $wpdb->prepare('
        SELECT * FROM ' . CM_Course_Table::table_name() . ' AS c JOIN ' . CM_Course_Content_Detail_Table::table_name() . ' AS ct 
        ON c.' . CM_Course_Table::$course_content_detail_id .' = ct.' . CM_Course_Content_Detail_Table::$course_content_detail_id . '
        WHERE c.' . CM_Course_Table::$course_id .' IN (' . $place_holders . ') AND ct.' . CM_Course_Content_Detail_Table::$locale . ' = %s
        ', $list_course_id);

        $result = $wpdb->get_results($stmt, ARRAY_A);
        return $result;
    }

    /**
     * Search for courses by key word
     * 
     * @param string $key_word Search key word
     * @return array The search results
     */
    public static function search_course($key_word = '') {
        global $wpdb;

        $posible_phrases = CM_Search_Helper::analyze_key_word($key_word);
        $where_sql = '';
        foreach ($posible_phrases as $idx => $phrase) {
            if ($idx !== 0) {
                $where_sql .= ' OR ';
            }

            $where_sql .= CM_Course_Table::$course_id . ' LIKE ' . '\'%' . $phrase . '%\'';
        }

        $stmt = $wpdb->prepare('
        SELECT * FROM ' . CM_Course_Table::table_name() . ' WHERE ' . $where_sql . '
        ', $posible_phrases);

        $result = $wpdb->get_results($stmt, ARRAY_A);
        return $result;
    }

    /**
     * Get courses by list of course ID
     * 
     * @param array $list_course_id The course id list
     * @return array The courses array
     */
    public static function get_courses_by_course_id_list($list_course_id = array()) {
        global $wpdb;

        $where_sql = '';

        for ($idx = 0; $idx < count($list_course_id); $idx++) { 
            if ($idx !== 0) {
                $where_sql .= ' OR ';
            }

            $where_sql .= CM_Course_Table::$course_id . ' = %s';
        }

        $stmt = $wpdb->prepare('
        SELECT * FROM ' . CM_Course_Table::table_name() . ' WHERE ' . $where_sql . '
        ', $list_course_id);

        $result = $wpdb->get_results($stmt, ARRAY_A);
        return $result;
    }
}