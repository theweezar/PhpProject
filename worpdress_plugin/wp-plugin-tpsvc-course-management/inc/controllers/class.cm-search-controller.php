<?php

class CM_Search_Controller {
    /**
     * Route submit search courses
     */
    public function route_submit_search_course() {
        CM_Request::verify_nonce('wp_search_nonce', CM_Request::get_param('_wpnonce'), is_admin());
        $key_word = CM_Request::get_param('keyword');
        $result = CM_Course_Mgr::search_course($key_word);
        wp_send_json(array(
            'result' => $result
        ));
    }

    /**
     * Route submit search courses that do not exist in category
     * ! This route is under development
     */
    public function route_submit_search_course_not_exist_in_category() {
        CM_Request::verify_nonce('wp_search_nonce', CM_Request::get_param('_wpnonce'), is_admin());
        $key_word = CM_Request::get_param('keyword');
        $current_category_id = CM_Request::get_param('current_category_id');

        // Search for courses and extract only course id then assign all of it to array
        $search_course_result = CM_Course_Mgr::search_course($key_word);
        $search_course_id_list = array_column($search_course_result, CM_Course_Table::$course_id);

        // Get course that exist in the current category and assign their ID to another array
        $existent_courses = CM_Category_Mgr::get_courses_in_category(
            $search_course_id_list,
            $current_category_id
        );
        $existent_course_id_list = array_column($existent_courses, CM_Course_Table::$course_id);

        $index_of_array = array();
        // Remove existent courses from the search results array
        $idx = 0;
        while (true) {
            $existent_course_id = $existent_course_id_list[$idx];
            $index_of = array_search($existent_course_id, $search_course_id_list);
            if ($index_of !== false) {
                array_splice($search_course_result, $index_of, $index_of + 1);
                array_push($index_of_array, $index_of);
                $idx--;
            }
            $idx++;
            if ($idx === count($search_course_result)) break;
        }

        wp_send_json(array(
            'result' => $search_course_result,
            'index_of_array' => $index_of_array
        ));
    }
}