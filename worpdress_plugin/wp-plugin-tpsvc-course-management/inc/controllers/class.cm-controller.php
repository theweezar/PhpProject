<?php

class CM_Controller {
    public static function get_node($controller_name, $route_name) {
        return array(
            'page' => 'course_management',
            'node' => $controller_name . '-' . $route_name
        );
    }
}