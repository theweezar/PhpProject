<?php

class CM_Category_Mgr {
    /**
     * Determine whether the category exists
     * 
     * @param string The category ID
     * @return bool Return true if there is a category with provided ID existed
     */
    public static function is_id_exist($category_id) {
        global $wpdb;
        $stmt = $wpdb->prepare('
        SELECT * FROM ' . CM_Category_Table::table_name() . ' WHERE ' . CM_Category_Table::$category_id . ' = %s
        ', array($category_id));
        $result = $wpdb->get_results($stmt, ARRAY_A);
        return count($result) !== 0;
    }

    /**
     * Create category
     * @param array $category The category array
     * @return int|false The number of rows updated, or false on error.
     */
    public static function create_category($category = array()) {
        global $wpdb;
        return $wpdb->insert(CM_Category_Table::table_name(), $category);
    }

    /**
     * Create category attribute
     * @param array $category_attribute The category attribute array
     * @return int|false The number of rows updated, or false on error.
     */
    public static function create_category_attribute($category_attribute = array()) {
        global $wpdb;
        return $wpdb->insert(CM_Category_Attribute_Table::table_name(), $category_attribute);
    }

    /**
     * Update category attribute
     * 
     * @param string $category_attribute The new data of category attribute
     * @param string $where Where to update
     */
    public static function update_category_attribute($category_attribute, $where) {
        global $wpdb;
        return $wpdb->update(
            CM_Category_Attribute_Table::table_name(),
            $category_attribute,
            $where
        );
    }

    /**
     * Delete all course from the category ID list
     * 
     * @param array $category_id_list Category ID list
     * @return int|bool Boolean true for CREATE, ALTER, TRUNCATE and DROP queries. Number of rows affected/selected for all other queries. Boolean false on error. 
     */
    public static function delete_courses_from_list_category($category_id_list = array()) {
        global $wpdb;
        // Create a place holder string based on the amount of category id %s, %s, %s, ...
        $place_holders = implode(', ', array_fill(0, count($category_id_list), '%s'));
        $stmt = $wpdb->prepare('
        DELETE FROM ' . CM_Category_Item_Table::table_name() . ' WHERE ' . CM_Category_Item_Table::$category_id . '
        IN (' . $place_holders . ');
        ', $category_id_list);
        return $wpdb->query($stmt);
    }

    /**
     * Delete categories based on the category ID list
     * 
     * @param array $category_id_list Category ID list
     * @return int|bool Boolean true for CREATE, ALTER, TRUNCATE and DROP queries. Number of rows affected/selected for all other queries. Boolean false on error. 
     */
    public static function delete_categories($category_id_list = array()) {
        global $wpdb;
        // Create a place holder string based on the amount of category id %s, %s, %s, ...
        $place_holders = implode(', ', array_fill(0, count($category_id_list), '%s'));
        $stmt = $wpdb->prepare('
        DELETE FROM ' . CM_Category_Table::table_name() . ' WHERE ' . CM_Category_Table::$category_id . '
        IN (' . $place_holders . ');
        ', $category_id_list);
        return $wpdb->query($stmt);
    }

    /**
     * Delete category attributes based on the category ID list
     * 
     * @param array $category_id_list Category ID list
     * @return int|bool Boolean true for CREATE, ALTER, TRUNCATE and DROP queries. Number of rows affected/selected for all other queries. Boolean false on error.
     */
    public static function delete_category_attributes($category_id_list = array()) {
        global $wpdb;
        // Create a place holder string based on the amount of category id %s, %s, %s, ...
        $place_holders = implode(', ', array_fill(0, count($category_id_list), '%s'));
        $stmt = $wpdb->prepare('
        DELETE FROM ' . CM_Category_Attribute_Table::table_name() . ' WHERE ' . CM_Category_Attribute_Table::$category_id . '
        IN (' . $place_holders . ');
        ', $category_id_list);
        return $wpdb->query($stmt);
    }

    /**
     * Get category base on category ID
     * 
     * @param string The category ID
     * @return array Return the category array
     */
    public static function get_category($category_id) {
        global $wpdb;
        $stmt = $wpdb->prepare('
        SELECT * FROM ' . CM_Category_Table::table_name() . ' WHERE ' . CM_Category_Table::$category_id . ' = %s
        ', array($category_id));
        $result = $wpdb->get_results($stmt, ARRAY_A);
        return $result;
    }

    /**
     * Get the category and its attributes by the category ID
     * 
     * @param string $category_id The category ID
     * @param string $locale The locale ID
     * @return array The category and its attribute array
     */
    public static function get_category_and_attributes($category_id, $locale = '') {
        global $wpdb;

        if (strcmp($locale, '') === 0) {
            $locale = Custom_Locale::$default_locale;
        }

        $stmt = $wpdb->prepare('
        SELECT * FROM ' . CM_Category_Table::table_name() . ' as cat JOIN ' . CM_Category_Attribute_Table::table_name() . ' AS cat_attr 
        ON cat.' . CM_Category_Table::$category_id . ' = cat_attr.' . CM_Category_Attribute_Table::$category_id . '
        WHERE cat.' . CM_Category_Table::$category_id . ' = %s and cat_attr.' . CM_Category_Attribute_Table::$locale . ' = %s
        ', array($category_id, $locale));

        $result = $wpdb->get_results($stmt, ARRAY_A);
        return $result;
    }

    /**
     * Get categories that belong to the parent category ID to display on the list
     * 
     * @param string $parent_category_id search for categories that belong to the parent category ID
     * @return array The results array
     */
    public static function get_categories_by($parent_category_id = '') {
        global $wpdb;
        // The master category will not have parent category id
        $where_sql = CM_Category_Table::$parent_category_id . ' IS NULL OR ' . CM_Category_Table::$parent_category_id . ' = %s';

        if (strcmp($parent_category_id, '') !== 0) {
            $where_sql = CM_Category_Table::$parent_category_id . '= %s';
        }

        // Can be empty or has the parent_category_id
        $prepare_array = array($parent_category_id);

        $stmt = $wpdb->prepare('
        SELECT * FROM ' . CM_Category_Table::table_name() . '
        WHERE ' . $where_sql . '
        ', $prepare_array);

        $result = $wpdb->get_results($stmt, ARRAY_A);
        return $result;
    }

    /**
     * Get the master category of the current category
     * 
     * @param string $current_category_id
     * @return string The master category ID
     */
    public static function get_master_category($current_category_id = '') {
        $result = self::get_category($current_category_id);
        $category = $result[0];
        $category_path = $category[CM_Category_Table::$category_path];

        if (strcmp($category_path, '') === 0) return $category[CM_Category_Table::$category_id];

        $path = explode('/', $category_path);

        return $path[1] ?? '';
    }

    /**
     * Get all the master categories
     * @return array The master category array
     */
    public static function get_all_master_categories() {
        global $wpdb;

        $stmt = '
        SELECT * FROM ' . CM_Category_Table::table_name() . ' AS c JOIN ' . CM_Category_Attribute_Table::table_name() . ' AS ca ON
        c.' . CM_Category_Table::$category_id . ' = ca.' . CM_Category_Attribute_Table::$category_id . '
        WHERE ('. CM_Category_Table::$parent_category_id . ' = \'\' OR '. CM_Category_Table::$parent_category_id . ' IS NULL)
        AND ' . CM_Category_Attribute_Table::$locale . ' = \'' . Custom_Locale::get_current_locale() . '\'
        ';

        $result = $wpdb->get_results($stmt, ARRAY_A);
        return $result;
    }

    /**
     * Get all sub categories by the parent category ID
     * @param string $current_category_id The parent category ID
     * @return array The sub categories array
     */
    public static function get_all_sub_categories($current_category_id = '') {
        global $wpdb;

        $stmt = $wpdb->prepare('
        SELECT * FROM ' . CM_Category_Table::table_name() . '
        WHERE '. CM_Category_Table::$category_path . ' LIKE %s
        ', array('%/' . $current_category_id . '/%'));

        $result = $wpdb->get_results($stmt, ARRAY_A);
        return $result;
    }

    /**
     * Get courses in category of the current category
     * 
     * @param string $category_id Category ID
     * @return array Return category item array
     */
    public static function get_all_courses_in_category($category_id = '') {
        global $wpdb;

        $stmt = $wpdb->prepare('
        SELECT * FROM ' . CM_Category_Item_Table::table_name() . '
        WHERE '. CM_Category_Item_Table::$category_id . ' = %s
        ', array($category_id));

        $result = $wpdb->get_results($stmt, ARRAY_A);
        return $result;
    }

    /**
     * Get all courses in master category
     * 
     * @param string $master_category_id The master category ID
     * @return array Return the array of course
     */
    public static function get_all_courses_in_master_category($master_category_id) {
        global $wpdb;

        $stmt = $wpdb->prepare('
        SELECT * FROM ' . CM_Category_Item_Table::table_name() . '
        WHERE '. CM_Category_Item_Table::$master_category_id . ' = %s
        ', array($master_category_id));

        $result = $wpdb->get_results($stmt, ARRAY_A);
        return $result;
    }

    /**
     * Determine whether course exists in the category
     * 
     * @param array $selected_course_id_list course id list
     * @param string $category_id Category ID
     * @return array Return courses array if courses in the list exist in category.
     */
    public static function get_courses_in_category($selected_course_id_list = array(), $category_id = '') {
        global $wpdb;
        $where_sql = '';
        $prepare_value = array();

        if (count($selected_course_id_list) === 0) return array();

        foreach ($selected_course_id_list as $idx => $course_id) {
            if ($idx !== 0) {
                $where_sql .= ' OR ';
            }
            $where_sql .= '(' . CM_Category_Item_Table::$category_id. ' = %s AND ' . CM_Category_Item_Table::$course_id . ' = %s)';
            array_push($prepare_value, $category_id, $course_id);
        }

        $stmt = $wpdb->prepare('SELECT * FROM ' . CM_Category_Item_Table::table_name() . ' WHERE '. $where_sql, $prepare_value);
        $result = $wpdb->get_results($stmt, ARRAY_A);
        return $result;
    }

    /**
     * Assign course to category
     * 
     * @param array $category_item Category Item
     * @return bool Return true, if query is correct
     */
    public static function assign_courses_into_category($category_items = array()) {
        global $wpdb;
        $existing_columns = $wpdb->get_col('DESC ' . CM_Category_Item_Table::table_name(), 0);
        $desc_table = implode(', ', $existing_columns);
        $insert_sql = 'INSERT INTO ' . CM_Category_Item_Table::table_name() . ' (' . $desc_table . ') VALUES';
        $prepare_value = array();
        $place_holders = array();

        foreach ($category_items as $idx => $item) {
            array_push(
                $prepare_value,
                $item[CM_Category_Item_Table::$category_id],
                $item[CM_Category_Item_Table::$course_id],
                $item[CM_Category_Item_Table::$master_category_id]
            );
            array_push($place_holders, '(%s, %s, %s)');
        }

        $insert_sql .= implode(', ', $place_holders);
        $stmt = $wpdb->prepare($insert_sql, $prepare_value);
        $result = $wpdb->get_results($stmt, ARRAY_A);
        return $result;
    }

    /**
     * Unassign course from category
     * 
     * @param array $category_item Category Item
     * @return int|bool Boolean true for CREATE, ALTER, TRUNCATE and DROP queries. Number of rows affected/selected for all other queries. Boolean false on error.
     */
    public static function unassign_courses_from_category($category_items = array()) {
        global $wpdb;
        $where_delete_sql = '';
        $prepare_value = array();
        foreach ($category_items as $idx => $item) {
            if ($idx !== 0) {
                $where_delete_sql .= ' OR ';
            }
            $where_delete_sql .= '(' . CM_Category_Item_Table::$category_id . '= %s AND ' . CM_Category_Item_Table::$course_id . '= %s)';
            array_push(
                $prepare_value,
                $item[CM_Category_Item_Table::$category_id],
                $item[CM_Category_Item_Table::$course_id]
            );
        }

        $stmt = $wpdb->prepare('DELETE FROM ' . CM_Category_Item_Table::table_name() . ' WHERE ' . $where_delete_sql, $prepare_value);
        return $wpdb->query($stmt);
    }

    /**
     * Delete the course from category
     * 
     * @param string $course_id The course ID
     * @return int|false The number of rows updated, or false on error.
     */
    public static function delete_course_from_category($course_id) {
        global $wpdb;

        return $wpdb->delete(CM_Category_Item_Table::table_name(), array(
            CM_Category_Item_Table::$course_id => $course_id
        ));
    }
}