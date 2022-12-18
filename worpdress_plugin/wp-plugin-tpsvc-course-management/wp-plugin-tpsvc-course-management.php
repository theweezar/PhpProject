<?php
/**
 * Plugin Name: Tecpro Services Course Management
 * Plugin URI: https://tecproservices.net/
 * Description: Course Management
 * Author: Tecpro Services
 * Author URI: https://tecproservices.net/
 * Version: 1.0
 * Text Domain: wp-plugin-tpsvc-course-management
 * Domain Path: /languages
 * Network: True
 */


// Make sure we don't expose any info if called directly
if (!function_exists('add_action')) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

define('COURSE_MANAGEMENT_DIR', plugin_dir_path( __FILE__ ) );

define('CLASS_DIR', 'inc/classes/' );

define('CONTROLER_DIR', 'inc/controllers/' );

define('VIEW_DIR', 'inc/views/' );

define('ASSET_DIR', 'assets/' );

require_once('loader.php');

CM_Initialization::init();