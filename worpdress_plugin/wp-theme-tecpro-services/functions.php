<?php
// Check if the plugin wp-plugin-tpsvc-course-management exists
if (!class_exists('CM_Initialization')) {
    return;
}

// Require object Course Management REST Api Endpoint
require_once(get_template_directory() . '/inc/classes/class.cm-rest-api.php');

require_once(get_template_directory() . '/inc/functions/class.fn-utils.php');

/**
 * Initialize some important variables
 */
function tecproservices_initialize() {
    // if(!session_id()) {
    //     session_start();
    // }

    Resource::load_context();
}

add_action('init', 'tecproservices_initialize', 1);

/**
 * Filter the menu item text to put it into the Resource get text method
 */
function tecproservices_filter_menu_item_to_resource($items) {
    foreach ($items as $idx => $item) {
        $item->title = Resource::text($item->title, 'all_menu');
    }
    return $items;
}

add_filter('wp_get_nav_menu_items', 'tecproservices_filter_menu_item_to_resource');

/**
 * Function load the dynamic title for all page.
 * Go to Setting -> edit Site Title
 */
function tecproservices_add_dynamic_title() {
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
}

add_action('after_setup_theme', 'tecproservices_add_dynamic_title');

/**
 * Function injects the css files into the <head> tag
 */
function tecproservices_inject_styles() {
    wp_enqueue_style('tecproservices-global-style',
                    esc_url(parse_url(get_template_directory_uri().'/style.css', PHP_URL_PATH)));
}

/**
 * Function injects the javascript into the HTML
 */
function tecproservices_inject_javascript() {
    wp_enqueue_script('tecproservices-global-script', esc_url(parse_url(get_template_directory_uri().'/assets/js/main.js', PHP_URL_PATH)));
}

add_action('wp_enqueue_scripts', 'tecproservices_inject_styles');
add_action('wp_enqueue_scripts', 'tecproservices_inject_javascript');

/**
 * Register the menu
 */
function tecproservices_menus() {
    $locations = array(
        'primary' => 'Main Menu',
        'social_menu' => 'Social Menu'
    );

    // This function will register the above menu config
    register_nav_menus($locations);
}

add_action('init', 'tecproservices_menus');

/**
 * Add the .active class in menu-item element when access to its link
 */
function tecproservices_add_active_menu_item_class($classes, $item){
     if( in_array('current-menu-item', $classes) ){
             $classes[] = ' active ';
     }
     return $classes;
}

add_filter('nav_menu_css_class' , 'tecproservices_add_active_menu_item_class' , 10 , 2);

/**
 * Register widget sidebar areas
 * %1$s is the ID
 */
function tecproservices_widget_register() {
    register_sidebar(array(
        'name' => 'Mobile Footer Widget',
        'id' => 'mobile-footer-widget',
        'before_widget'  => '<div class="custom-dropdown-menu col-lg-6">',
        'after_widget'   => '</div>',
        'before_title'   => '<div class="custom-dropdown-trigger d-flex align-items-center"> <h4>',
        'after_title'    => '</h4> <span class="icon-arrow ml-auto d-lg-none"><i class="fa fa-angle-down" aria-hidden="true"></i></span> </div>',
        'before_sidebar' => '<div class="%1$s d-lg-flex flex-row flex-wrap" id="%1$s">',
        'after_sidebar'  => '</div>'
    ));
}

add_action('widgets_init', 'tecproservices_widget_register');

?>