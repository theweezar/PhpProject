<?php

class CM_Template {
    public static function render($template, $args = array()) {
        require(COURSE_MANAGEMENT_DIR . VIEW_DIR . 'layout/view.course-management-admin-header.php');

        echo '<!-- Render template: ' . $template . ' -->';

        require(COURSE_MANAGEMENT_DIR . VIEW_DIR . $template);
    }

    public static function asset_link($path = '') {
        return esc_url(COURSE_MANAGEMENT_DIR . ASSET_DIR . $path);
    }
}

?>