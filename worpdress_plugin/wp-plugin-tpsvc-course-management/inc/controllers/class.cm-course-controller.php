<?php

class CM_Course_Controller {

    /**
     * Render the course management menu page
     */
    public function route_render_couse_management_index_page() {
        require(COURSE_MANAGEMENT_DIR . VIEW_DIR . 'layout/view.course-management-admin-header.php');
    }

    /**
     * Render the course listing admin page
     */
    public function route_render_course_dashboard() {
        $courses = CM_Course_Mgr::get_courses();

        CM_Template::render('course/view.course-dashboard.php', array(
            'courses' => $courses,
            'delete_ajax_action' => 'submit_delete_course',
            'delete_nonce' => wp_create_nonce('wp_admin_delete_course')
        ));
    }

    /**
     * Render the course form page based on the page_action
     */
    public function route_render_course_form_page() {
        $page_action = CM_Request::get_param('page_action');
        $course_form = new CM_Course_Form();
        $ajax_action = 'submit_add_new_course';
        $nonce_name = 'wp_admin_add_new_course';
        $course_id = '';

        if (strcmp($page_action, CM_Main::$page_action_edit) === 0) {
            $course_id = CM_Request::get_param(CM_Course_Table::$course_id);

            if (!isset($course_id) || !CM_Course_Mgr::is_column_value_exist(CM_Course_Table::$course_id, $course_id)) {
                wp_die('Course ID doesn\'t exist');
            }

            $course = CM_Course_Mgr::get_course_by_id($course_id);
            $course_form->set_form_values($course[0]);
            $ajax_action = 'submit_update_course';
            $nonce_name = 'wp_admin_update_course';
        }

        CM_Template::render('course/view.course-form.php', array(
            'course_form' => $course_form->get_form(),
            'ajax_action' => $ajax_action,
            'nonce_name' => $nonce_name,
            'current_course_id' => $course_id
        ));
    }

    /**
     * Submit creating new course
     */
    public function route_submit_add_new_course() {
        CM_Request::verify_nonce('wp_admin_add_new_course', CM_Request::get_param('_wpnonce'), is_admin() /** is_user_logged_in() */);

        $new_course = array(
            CM_Course_Table::$course_id => CM_Request::get_param(CM_Course_Table::$course_id),
            CM_Course_Table::$course_name => CM_Request::get_param(CM_Course_Table::$course_name),
            CM_Course_Table::$price => CM_Request::get_param(CM_Course_Table::$price),
            CM_Course_Table::$discount_price => CM_Request::get_param(CM_Course_Table::$discount_price),
            CM_Course_Table::$number_of_student => CM_Request::get_param(CM_Course_Table::$number_of_student),
            CM_Course_Table::$start_register_date => CM_Request::get_param(CM_Course_Table::$start_register_date),
            CM_Course_Table::$end_register_date => CM_Request::get_param(CM_Course_Table::$end_register_date),
            CM_Course_Table::$start_date => CM_Request::get_param(CM_Course_Table::$start_date),
            CM_Course_Table::$end_date => CM_Request::get_param(CM_Course_Table::$end_date),
            CM_Course_Table::$level => CM_Request::get_param(CM_Course_Table::$level),
            CM_Course_Table::$course_content_detail_id => CM_Request::get_param(CM_Course_Table::$course_content_detail_id),
            CM_Course_Table::$created_at => date("Y-m-d h:i:s"),
            CM_Course_Table::$instructor_name => CM_Request::get_param(CM_Course_Table::$instructor_name)
        );

        $response = array(
            'success' => false
        );

        $is_id_exist = CM_Course_Mgr::is_column_value_exist(CM_Course_Table::$course_id, $new_course[CM_Course_Table::$course_id]);

        if ($is_id_exist) {
            $response['message'] = 'Course existed';
            wp_send_json($response);
        }

        $is_valid_date_fields = CM_Course_Helper::is_validate_date_fields(
            $new_course[CM_Course_Table::$start_register_date],
            $new_course[CM_Course_Table::$end_register_date],
            $new_course[CM_Course_Table::$start_date],
            $new_course[CM_Course_Table::$end_date]
        );

        if (!$is_valid_date_fields) {
            $response['message'] = 'Date fields are invalid';
            wp_send_json($response);
        }

        $success = CM_Course_Mgr::create_course($new_course);

        $response = array(
            'success' => $success,
            'redirect_url' => add_query_arg(array_merge(
                CM_Controller::get_node('CM_Course_Controller', 'route_render_course_form_page'),
                array(
                    'page_action' => CM_Main::$page_action_edit,
                    CM_Course_Table::$course_id => $new_course[CM_Course_Table::$course_id]
                )
            ), admin_url('admin.php'))
        );

        wp_send_json($response);
    }

    /**
     * Submit updating current post
     */
    public function route_submit_update_course() {
        CM_Request::verify_nonce('wp_admin_update_course', CM_Request::get_param('_wpnonce'), is_admin());

        $updating_course = array(
            CM_Course_Table::$course_name => CM_Request::get_param(CM_Course_Table::$course_name),
            CM_Course_Table::$price => CM_Request::get_param(CM_Course_Table::$price),
            CM_Course_Table::$discount_price => CM_Request::get_param(CM_Course_Table::$discount_price),
            CM_Course_Table::$number_of_student => CM_Request::get_param(CM_Course_Table::$number_of_student),
            CM_Course_Table::$start_register_date => CM_Request::get_param(CM_Course_Table::$start_register_date),
            CM_Course_Table::$end_register_date => CM_Request::get_param(CM_Course_Table::$end_register_date),
            CM_Course_Table::$start_date => CM_Request::get_param(CM_Course_Table::$start_date),
            CM_Course_Table::$end_date => CM_Request::get_param(CM_Course_Table::$end_date),
            CM_Course_Table::$level => CM_Request::get_param(CM_Course_Table::$level),
            CM_Course_Table::$course_content_detail_id => CM_Request::get_param(CM_Course_Table::$course_content_detail_id),
            CM_Course_Table::$instructor_name => CM_Request::get_param(CM_Course_Table::$instructor_name)
        );

        $course_id = CM_Request::get_param(CM_Course_Table::$course_id);

        $is_valid_date_fields = CM_Course_Helper::is_validate_date_fields(
            $updating_course[CM_Course_Table::$start_register_date],
            $updating_course[CM_Course_Table::$end_register_date],
            $updating_course[CM_Course_Table::$start_date],
            $updating_course[CM_Course_Table::$end_date]
        );

        if (!$is_valid_date_fields) {
            $response['message'] = 'Date fields are invalid';
            wp_send_json($response);
        }

        $success = CM_Course_Mgr::update_course($updating_course, array(
            CM_Course_Table::$course_id => $course_id
        ));

        $response = array(
            'success' => $success,
            'message' => 'Update course with ID "' . $course_id . '" successfully.',
            'updated_course' => $updating_course
        );

        wp_send_json($response);
    }

    /**
     * Submit delete the course
     */
    public function route_submit_delete_course() {
        $course_id = CM_Request::get_param('deleteTargetID');
        CM_Category_Mgr::delete_course_from_category($course_id);
        CM_Course_Mgr::delete_course($course_id);

        $response = array(
            'success' => true,
            'deleted_course_id' => $course_id
        );

        wp_send_json($response);
    }

    /**
     * Render the course content listing admin page
     */
    public function route_render_course_content_detail_dashboard() {
        $course_contents =  CM_Course_Mgr::get_course_contents();
        $delete_nonce = wp_create_nonce('wp_admin_delete_course_content');

        CM_Template::render('course/view.course-content-detail-dashboard.php', array(
            'course_contents' => $course_contents,
            'delete_nonce' => $delete_nonce,
            'delete_ajax_action' => 'submit_delete_course_content'
        ));
    }

    /**
     * Render the course content form based on page_action and the locale
     */
    public function route_render_course_content_detail_form_page() {
        $page_action = CM_Request::get_param('page_action');
        $ajax_action = 'submit_add_new_course_content';
        $course_ct_form = new CM_Course_Content_Detail_Form();
        $current_course_ct_id = '';

        if (strcmp($page_action, CM_Main::$page_action_edit) === 0) {
            $course_content_id = CM_Request::get_param(CM_Course_Content_Detail_Table::$course_content_detail_id);
            $locale = CM_Request::get_param(CM_Course_Content_Detail_Table::$locale);

            if (!isset($course_content_id) || !CM_Course_Mgr::is_course_content_id_exist($course_content_id)) {
                wp_die('Course content ID doesn\'t exist');
            }

            if (!Custom_Locale::is_exist($locale)) {
                $locale = Custom_Locale::$default_locale;
            }

            $course_content = CM_Course_Mgr::get_course_content_by_id($course_content_id, $locale);

            if (count($course_content) !== 0) {
                $course_ct_form->set_form_values($course_content[0]);
                $course_ct_form->set_form_selected_value(
                    CM_Course_Content_Detail_Table::$locale, $course_content[0][CM_Course_Content_Detail_Table::$locale]
                );
                $current_course_ct_id = $course_content[0][CM_Course_Content_Detail_Table::$course_content_detail_id];
            }

            $ajax_action = 'submit_update_course_content';
        } else {
            $page_action = CM_Main::$page_action_new;
        }

        CM_Template::render('course/view.course-content-detail-form.php', array(
            'course_ct_form' => $course_ct_form->get_form(),
            'current_course_ct_id' => $current_course_ct_id,
            'page_action' => $page_action,
            'ajax_action' => $ajax_action
        ));
    }

    /**
     * Submit creating new course content
     */
    public function route_submit_add_new_course_content() {
        CM_Request::verify_nonce('wp_admin_add_new_course_content', CM_Request::get_param('_wpnonce'), is_admin());

        $new_course_content = array(
            CM_Course_Content_Detail_Table::$locale => Custom_Locale::$default_locale,
            CM_Course_Content_Detail_Table::$course_content_detail_id => CM_Request::get_param(CM_Course_Content_Detail_Table::$course_content_detail_id),
            CM_Course_Content_Detail_Table::$course_thumbnail_url => '',
            CM_Course_Content_Detail_Table::$short_description => '',
            CM_Course_Content_Detail_Table::$about_this_course => '',
            CM_Course_Content_Detail_Table::$what_you_will_learn => '',
            CM_Course_Content_Detail_Table::$additional_content => ''
        );

        $response = array(
            'success' => false
        );
        $success = false;

        $is_id_exist = CM_Course_Mgr::is_course_content_id_exist($new_course_content[CM_Course_Content_Detail_Table::$course_content_detail_id]);

        if ($is_id_exist) {
            $response['message'] = 'Course content ID existed';
            wp_send_json($response);
        }
        
        // TODO: Refactor code insert multiple locale content
        foreach (Custom_Locale::$locales as $key => $locale) {
            $new_course_content[CM_Course_Content_Detail_Table::$locale] = $key;
            $success = CM_Course_Mgr::create_course_content_detail($new_course_content);
        }

        if ($success) {
            $response = array(
                'success' => $success,
                'redirect_url' => add_query_arg(array_merge(
                    CM_Controller::get_node('CM_Course_Controller', 'route_render_course_content_detail_form_page'),
                    array(
                        'page_action' => CM_Main::$page_action_edit,
                        CM_Course_Content_Detail_Table::$course_content_detail_id => $new_course_content[CM_Course_Content_Detail_Table::$course_content_detail_id],
                        CM_Course_Content_Detail_Table::$locale => Custom_Locale::$default_locale
                    )
                ), admin_url('admin.php'))
            );
        } else {
            $response['message'] = 'Create new course content failed';
        }       

        wp_send_json($response);
    }

    /**
     * Submit updating current course content
     */
    public function route_submit_update_course_content() {
        CM_Request::verify_nonce('wp_admin_add_new_course_content', CM_Request::get_param('_wpnonce'), is_admin());

        $updating_course_content = array(
            CM_Course_Content_Detail_Table::$course_thumbnail_url => CM_Request::get_param(CM_Course_Content_Detail_Table::$course_thumbnail_url, false),
            CM_Course_Content_Detail_Table::$short_description => CM_Request::get_param(CM_Course_Content_Detail_Table::$short_description, false),
            CM_Course_Content_Detail_Table::$about_this_course => htmlentities(CM_Request::get_param(CM_Course_Content_Detail_Table::$about_this_course, false), ENT_QUOTES),
            CM_Course_Content_Detail_Table::$what_you_will_learn => htmlentities(CM_Request::get_param(CM_Course_Content_Detail_Table::$what_you_will_learn, false), ENT_QUOTES),
            CM_Course_Content_Detail_Table::$additional_content => htmlentities(CM_Request::get_param(CM_Course_Content_Detail_Table::$additional_content, false), ENT_QUOTES)
        );

        $response = array(
            'success' => false
        );

        $course_content_id = CM_Request::get_param(CM_Course_Content_Detail_Table::$course_content_detail_id);
        $locale = CM_Request::get_param(CM_Course_Content_Detail_Table::$locale);

        // Check locale
        if (!isset($locale) || !Custom_Locale::is_exist($locale)) {
            $response['message'] = 'Locale is invalid';
            wp_send_json($response);
        }

        $success = CM_Course_Mgr::update_course_content_detail($updating_course_content, array(
            CM_Course_Content_Detail_Table::$course_content_detail_id => $course_content_id,
            CM_Course_Content_Detail_Table::$locale => $locale
        ));

        $response = array(
            'success' => $success,
            'message' => 'Update course content with ID "' . $course_content_id . '" successfully.',
            'updated_course_content' => $updating_course_content
        );

        wp_send_json($response);
    }

    /**
     * Submit delete the course content detail
     */
    public function route_submit_delete_course_content() {
        CM_Request::verify_nonce('wp_admin_delete_course_content', CM_Request::get_param('_wpnonce'), is_admin());

        $response = array(
            'success' => false
        );

        $delete_course_content_id = CM_Request::get_param('deleteTargetID');

        $delete_course_content = array(
            CM_Course_Content_Detail_Table::$course_content_detail_id => $delete_course_content_id
        );

        $is_id_exist = CM_Course_Mgr::is_course_content_id_exist($delete_course_content_id);

        if (!$is_id_exist) {
            $response['message'] = 'Course content does not exist';
            wp_send_json($response);
        }

        $success = CM_Course_Mgr::delete_course_content_detail($delete_course_content);

        if ($success === false) {
            $response['message'] = 'Fail to delete the course content with ID ' . $delete_course_content_id;
        } else {
            $response['success'] = true;
            $response['deleted_id'] = $delete_course_content_id;
        }

        wp_send_json($response);
    }
}