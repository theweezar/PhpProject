<?php

class CM_Initialization {
    public static function init() {
		$cm_init = new CM_Initialization();
		$cm_init->init_action();
	}

	public function init_action() {
		add_action('init', array($this, 'init_main'));
		
		add_action('admin_enqueue_scripts', array($this, 'init_client_script'));
	}

	public function init_main() {
		new CM_Main();
		new CM_Database();
	}

	public function init_client_script() {
		// Only load these resourses if the user accesses the Course Management admin page
		if (strcmp(CM_Request::get_param('page'), 'course_management') === 0) {
			wp_enqueue_style('tpsvc-course-management-style', plugins_url('../assets/css/main.css', __FILE__), array(), rand());
			wp_enqueue_script('tpsvc-course-management-javascript', plugins_url('../assets/js/main.js', __FILE__), array(), rand());
		}
	}
}
