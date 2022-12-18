<?php

class CM_Category_Controller {
    /**
     * Render the category dashboard
     */
    public function route_render_category_dashboard() {
        $parent_category_id = CM_Request::get_param(CM_Category_Table::$parent_category_id);
        $pre_parent_category_id = '';
        $delete_ajax_action = 'submit_delete_category';
        $delete_wpnonce_name = 'wp_admin_delete_category';
        $current_category_id = '';
        $course_in_category = array();

        // Get the categories belong to the parent category ID
        $categories = CM_Category_Mgr::get_categories_by($parent_category_id);

        if (strcmp($parent_category_id, '') !== 0) {
            $parent_category = CM_Category_Mgr::get_category($parent_category_id);
            $pre_parent_category_id = $parent_category[0][CM_Category_Table::$parent_category_id];
            $current_category_id = $parent_category_id;
        }

        if (strcmp($current_category_id, '') !== 0) {
            $course_in_category = CM_Category_Mgr::get_all_courses_in_category($current_category_id);
        }

        CM_Template::render('category/view.category-dashboard.php', array(
            'categories' => $categories,
            'pre_parent_category_id' => $pre_parent_category_id,
            'delete_ajax_action' => $delete_ajax_action,
            'delete_wpnonce' => wp_create_nonce($delete_wpnonce_name),
            'current_category_id' => $current_category_id,
            'course_in_category' => $course_in_category,
            CM_Category_Table::$parent_category_id => $parent_category_id
        ));
    }

    /**
     * Render the category form page
     */
    public function route_render_category_form_page() {
        $page_action = CM_Request::get_param('page_action');
        $ajax_action = 'submit_add_new_category';
        $category_form = new CM_Category_Form();
        $wpnonce_name = 'wp_admin_add_new_category';
        $parent_category_id = CM_Request::get_param(CM_Category_Table::$parent_category_id);

        // Check parent category whether it exists
        if (strcmp($parent_category_id, '') !== 0 && !CM_Category_Mgr::is_id_exist($parent_category_id)) {
            wp_die('Parent category doesn\'t exist');
        }

        // If user requests to EDIT
        if (strcmp($page_action, CM_Main::$page_action_edit) === 0) {
            $ajax_action = 'submit_update_category';
            $wpnonce_name = 'wp_admin_update_category';
            $category_id = CM_Request::get_param(CM_Category_Table::$category_id);
            $locale = CM_Request::get_param(CM_Category_Attribute_Table::$locale);
            $is_id_exist = CM_Category_Mgr::is_id_exist($category_id);

            if (!$is_id_exist) {
                wp_die('Category doesn\'t exist');
            }

            $category = CM_Category_Mgr::get_category_and_attributes($category_id, $locale);
            
            if (count($category) !== 0) {
                $category_form->set_form_values($category[0]);
                $category_form->set_form_selected_value(
                    CM_Category_Attribute_Table::$locale, $category[0][CM_Category_Attribute_Table::$locale]
                );
            }
        } else {
            $page_action = CM_Main::$page_action_new;
        }

        CM_Template::render('category/view.category-form.php', array(
            'category_form' => $category_form->get_form(),
            'page_action' => $page_action,
            'ajax_action' => $ajax_action,
            'wpnonce_name' => $wpnonce_name,
            CM_Category_Table::$parent_category_id => $parent_category_id
        ));
    }

    /**
     * Submit add new category
     */
    public function route_submit_add_new_category() {
        CM_Request::verify_nonce('wp_admin_add_new_category', CM_Request::get_param('_wpnonce'), is_admin());

        $response = array(
            'success' => false
        );

        $category_id = CM_Request::get_param(CM_Category_Table::$category_id);
        $parent_category_id = CM_Request::get_param(CM_Category_Table::$parent_category_id);
        $new_category = array(
            CM_Category_Table::$category_id => $category_id,
            CM_Category_Table::$parent_category_id => $parent_category_id,
            CM_Category_Table::$category_path => '',
            CM_Category_Table::$created_at => date("Y-m-d h:i:s")
        );
        // Get parent category
        $parent_category = CM_Category_Mgr::get_category($parent_category_id);

        // Check parent category whether it exists
        if (strcmp($parent_category_id, '') !== 0 && count($parent_category) === 0) {
            wp_die('Parent category doesn\'t exist');
        }

        // Check if the new category id existed
        if (CM_Category_Mgr::is_id_exist($category_id)) {
            $response['message'] = 'Category existed';
            wp_send_json($response);
        }

        // Create the new category path based on parent category path
        if (count($parent_category) !== 0) {
            $parent_category_path = $parent_category[0][CM_Category_Table::$category_path];
            $new_category[CM_Category_Table::$category_path] = empty($parent_category_path)
                            ? sprintf('%s%s/', $parent_category_id, $category_id)
                            : sprintf('%s%s/', $parent_category_path, $category_id);
        } else {
            $new_category[CM_Category_Table::$category_path] = sprintf('/%s/', $category_id);
        }

        // Create new category
        $success = CM_Category_Mgr::create_category($new_category);

        if (!$success) {
            $response['message'] = 'Failed to create new category.';
            wp_send_json($response);
        }

        // TODO: Refactor code insert multiple locale content
        foreach (Custom_Locale::$locales as $key => $locale) {
            $new_category_attr = array(
                CM_Category_Attribute_Table::$locale => $key,
                CM_Category_Attribute_Table::$category_id => $category_id,
                CM_Category_Attribute_Table::$category_name => ''
            );
            CM_Category_Mgr::create_category_attribute($new_category_attr);
        }

        $response = array(
            'success' => true,
            'redirect_url' => add_query_arg(array_merge(
                CM_Controller::get_node('CM_Category_Controller', 'route_render_category_form_page'),
                array(
                    'page_action' => CM_Main::$page_action_edit,
                    CM_Category_Table::$category_id => $category_id,
                    CM_Category_Attribute_Table::$locale => Custom_Locale::$default_locale
                )
            ), admin_url('admin.php'))
        );

        wp_send_json($response);
    }

    /**
     * Route submit update category attributes
     */
    public function route_submit_update_category() {
        CM_Request::verify_nonce('wp_admin_update_category', CM_Request::get_param('_wpnonce'), is_admin());

        $category_id = CM_Request::get_param(CM_Category_Attribute_Table::$category_id);
        $locale = CM_Request::get_param(CM_Category_Attribute_Table::$locale);
        $updating_category = array(
            CM_Category_Attribute_Table::$category_name => CM_Request::get_param(CM_Category_Attribute_Table::$category_name)
        );
        $response = array(
            'success' => false
        );

        if (!isset($locale) || !Custom_Locale::is_exist($locale)) {
            $response['message'] = 'Locale is invalid';
            wp_send_json($response);
        }

        $success = CM_Category_Mgr::update_category_attribute($updating_category, array(
            CM_Category_Attribute_Table::$category_id => $category_id,
            CM_Category_Attribute_Table::$locale => $locale
        ));

        $response = array(
            'success' => $success,
            'message' => 'Update course content with ID "' . $category_id . '" successfully.'
        );

        wp_send_json($response);
    }

    /**
     * Route submit delete the category and its sub-category, assigned courses
     */
    public function route_submit_delete_category() {
        CM_Request::verify_nonce('wp_admin_delete_category', CM_Request::get_param('_wpnonce'), is_admin());

        $target_category_id = CM_Request::get_param('deleteTargetID');
        $category_rs = CM_Category_Mgr::get_category($target_category_id);
        $response = array(
            'success' => false
        );

        if (count($category_rs) === 0) {
            $response['message'] = 'Category does not exist.';
            wp_send_json($response);
        }

        $sub_categories = CM_Category_Mgr::get_all_sub_categories($target_category_id);
        $category_id_list = array_column($sub_categories, CM_Category_Table::$category_id);
        // TODO: Delete assigned courses
        CM_Category_Mgr::delete_courses_from_list_category($category_id_list);
        // TODO: Delete the target category and its sub-categories and all attributes
        CM_Category_Mgr::delete_categories($category_id_list);
        CM_Category_Mgr::delete_category_attributes($category_id_list);

        $response = array(
            'success' => true,
            'category_id_list' => $category_id_list,
            'deleted_category_id' => $target_category_id,
            'db_log' => CM_Database::get_simple_log()
        );

        wp_send_json($response);
    }

    /**
     * Render the category relation between category and course page
     */
    public function route_render_courses_assign_page() {
        $category_id = CM_Request::get_param(CM_Category_Table::$category_id);

        $category_items = CM_Category_Mgr::get_all_courses_in_category($category_id);

        CM_Template::render('category/view.category-course-assign.php', array(
            'current_category_id' => $category_id,
            'category_items' => $category_items,
            'search_ajax_action' => 'submit_search_course',
            'assign_course_ajax_action' => 'assign_course_to_category',
            'remove_course_ajax_action' => 'unassign_course_from_category',
            'search_nonce_name' => 'wp_search_nonce'
        ));
    }

    /**
     * Route assign course to category
     */
    public function route_assign_course_to_category() {
        // ! NOTE: verify nonce in the next phase
        $selected_course_id_list = CM_Request::get_param('selectedCourseIDList');
        $current_category_id = CM_Request::get_param('categoryID');
        $courses = CM_Course_Mgr::get_courses_by_course_id_list($selected_course_id_list);
        $response = array(
            'success' => false
        );

        // Get master category id to assign course
        $master_category_id = CM_Category_Mgr::get_master_category($current_category_id);

        // Check if these course ids exist in the current category
        $assume_existent_courses = CM_Category_Mgr::get_courses_in_category(
            $selected_course_id_list,
            $current_category_id
        );

        if (count($assume_existent_courses) !== 0) {
            $response['existent_course_list'] = $assume_existent_courses;
            wp_send_json($response);
        }

        $new_category_items = array();
        foreach ($courses as $idx => $course) {
            $category_item = array(
                CM_Category_Item_Table::$category_id => $current_category_id,
                CM_Category_Item_Table::$course_id => $course[CM_Course_Table::$course_id],
                CM_Category_Item_Table::$master_category_id => $master_category_id,
            );
            array_push($new_category_items, $category_item);
        }

        CM_Category_Mgr::assign_courses_into_category($new_category_items);

        $last_error = CM_Database::get_last_error();

        if (strcmp($last_error, '') !== 0) {
            $response['message'] = $last_error;
        } else {
            $response['success'] = true;
            $response['courses'] = CM_Category_Mgr::get_all_courses_in_category($current_category_id);
        }

        wp_send_json($response);
    }

    /**
     * Route remove course from category
     */
    public function route_unassign_course_from_category() {
        // ! NOTE: verify nonce in the next phase
        $selected_course_id_list = CM_Request::get_param('selectedCourseIDList');
        $current_category_id = CM_Request::get_param('categoryID');
        // $existent_courses = CM_Category_Mgr::get_courses_in_category(
        //     $selected_course_id_list,
        //     $current_category_id
        // );
        $response = array(
            'success' => false
        );
        $course_list_to_delete = array();

        foreach ($selected_course_id_list as $idx => $selected_course_id) {
            array_push($course_list_to_delete, array(
                CM_Category_Item_Table::$category_id => $current_category_id,
                CM_Category_Item_Table::$course_id => $selected_course_id,
            ));
        }

        CM_Category_Mgr::unassign_courses_from_category($course_list_to_delete);

        $course_list_after_deleting = CM_Category_Mgr::get_all_courses_in_category($current_category_id);

        $response['course_list_after_deleting'] = $course_list_after_deleting;
        $response['success'] = true;

        wp_send_json($response);
    }
}