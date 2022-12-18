<?php

class CM_Main {
    public static $page_action_new = 'new';
    public static $page_action_edit = 'edit';

    public function __construct() {
        $this->activate_actions();
		$this->register_admin_ajax_course();
    }

    /**
	 * Register listeners for actions
	 *
	 * @return void
	 */
    public function activate_actions() {
        add_action('admin_menu', array($this, 'admin_menu'));

		add_action('rest_api_init', array($this, 'register_all_routes'));
    }

	/**
	 * Register listeners to create admin menu
	 *
	 * @return void
	 */
    public function admin_menu() {
        add_menu_page(
			'Course Management',
			'Course Management',
			'manage_options',
			'course_management',
			array($this, 'navigate_request_to_controller'),
			'',
			1
		);
    }

	/**
	 * Parse the node parameter to controller and its method value
	 */
	public function parse_controller_and_method() {
		$node = CM_Request::get_param('node');
		$controller_class = 'CM_Course_Controller';
		$route_method = 'route_render_couse_management_index_page';
		$is_skip_check_node = false;

		if (strcmp($node, '') === 0) {
			$is_skip_check_node = true;
		}

		$node_exp = explode('-', $node);

		if (count($node_exp) !== 2 && !$is_skip_check_node) {
			return null;
		}

		if (!$is_skip_check_node) {
			$controller_class = $node_exp[0];
			$route_method = $node_exp[1];
		}

		return array(
			'controller_class' => $controller_class,
			'route_method' => $route_method
		);
	}

	/**
	 * Navigate the request to the controller
	 */
	public function navigate_request_to_controller() {
		$parsed_node = $this->parse_controller_and_method();

		if (!isset($parsed_node)) {
			echo 'Error: Page not found';
			return;
		}

		$controller_class = $parsed_node['controller_class'];
		$route_method = $parsed_node['route_method'];

		if (!class_exists($controller_class)) {
			echo 'Error: Controller not found';
			return;
		}
		
		$controller = new $controller_class;

		if (!method_exists($controller, $route_method)) {
			echo 'Error: Route not found';
			return;
		}

		call_user_func_array(
			array($controller, $route_method),
			array()
		);
	}

	public function custom_add_action($hook_name, $controller_class, $method) {
		$controller = new $controller_class;
		add_action($hook_name, array(&$controller, $method));
	}

	/**
	 * Init ajax action for admin management
	 */
	public function register_admin_ajax_course() {
		// Course ajax actions
		$this->custom_add_action('admin_post_submit_add_new_course', 'CM_Course_Controller', 'route_submit_add_new_course');

		$this->custom_add_action('admin_post_submit_update_course', 'CM_Course_Controller', 'route_submit_update_course');

		$this->custom_add_action('admin_post_submit_delete_course', 'CM_Course_Controller', 'route_submit_delete_course');

		// Course content detail actions
		$this->custom_add_action('admin_post_submit_add_new_course_content', 'CM_Course_Controller', 'route_submit_add_new_course_content');

		$this->custom_add_action('admin_post_submit_update_course_content', 'CM_Course_Controller', 'route_submit_update_course_content');

		$this->custom_add_action('admin_post_submit_delete_course_content', 'CM_Course_Controller', 'route_submit_delete_course_content');

		// Category actions
		$this->custom_add_action('admin_post_submit_add_new_category', 'CM_Category_Controller', 'route_submit_add_new_category');

		$this->custom_add_action('admin_post_submit_update_category', 'CM_Category_Controller', 'route_submit_update_category');

		$this->custom_add_action('admin_post_submit_delete_category', 'CM_Category_Controller', 'route_submit_delete_category');

		$this->custom_add_action('admin_post_assign_course_to_category', 'CM_Category_Controller', 'route_assign_course_to_category');

		$this->custom_add_action('admin_post_unassign_course_from_category', 'CM_Category_Controller', 'route_unassign_course_from_category');

		// Search actions
		$this->custom_add_action('wp_ajax_submit_search_course', 'CM_Search_Controller', 'route_submit_search_course');

		$this->custom_add_action('wp_ajax_submit_search_course_not_exist_in_category', 'CM_Search_Controller', 'route_submit_search_course_not_exist_in_category');
	
		// Custom media actions
		$this->custom_add_action('admin_post_submit_upload_custom_media', 'CM_Media_Controller', 'route_submit_upload_custom_media');

		$this->custom_add_action('wp_ajax_get_media_tree_data', 'CM_Media_Controller', 'route_get_media_tree_data');
	}

	/**
	 * Register all ajax action routes for reader site
	 *
	 * @return void
	 */
	public function register_all_routes() {
		register_rest_route('cm/v1', 'register-student', array(
			'methods' => 'POST',
			'callback' => 'CM_Student_Controller::route_register_student'
		));

		register_rest_route('cm/v1', 'login-student', array(
			'methods' => 'POST',
			'callback' => 'CM_Student_Controller::route_login_student'
		));
	}
}