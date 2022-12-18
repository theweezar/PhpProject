<?php

class Fn_Utils {
    /**
     * Get page content by page path
     */
    public static function get_page_content($page_path) {
        $current_locale = Custom_Locale::get_current_locale();
        $locale_page_path = $current_locale . '-' . $page_path;
        $page = get_page_by_path($locale_page_path);

        //! TODO: Update the logic to execute PHP script. HIGH PRIORITY
        if (isset($page)) {
            echo '<!-- Page ID: ' . $locale_page_path . ' -->';
            $page_content = $page->post_content;
            ob_start();
            eval('?>' . $page_content);
            $ob_page_content = ob_get_clean();
            return apply_filters('the_content', $ob_page_content);
        } else {
            return "Page $locale_page_path is not found";
        }
    }

    /**
     * Locate the exist template in theme folder. If it exists, theme will load that template
     */
    public static function render_custom_page_by_url($args = array()) {
        global $post;
        $slug_name = $post->post_name;
        $slug_local_path = '/template-parts/page/page-' . $slug_name;

        if (!empty(locate_template($slug_local_path.'.php'))) {
            get_template_part($slug_local_path, '', $args);
        }
    }

    /**
     * Parse the page URL
     * @param string $name The slug name
     * @return string The page url
     */
    public static function parse_page_url($name = '') {
        return esc_url(get_permalink(get_page_by_path($name)));
    }

    /**
     * Parse the post URL
     * @param string $name The slug name
     * @return string The post url
     */
    public static function parse_post_url($name = '') {
        return esc_url(get_post_permalink(get_page_by_path($name, OBJECT, 'post')));
    }

    /**
     * Redirect to 404 page
     */
    public static function redirect_to_404($error_message = '') {
        global $wp_query;
        $wp_query->set_404();
        status_header(404);
        get_template_part(404, array(
            'error_message' => $error_message
        ));
    }
}
