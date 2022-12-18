<?php

class CM_Request {
    public static function verify_nonce($nonce_name, $nonce_value, $is_admin = false) {
        $is_valid = wp_verify_nonce($nonce_value, $nonce_name);

        if ($is_admin) {
            if (!$is_valid) {
                wp_send_json(array(
                    'success' => false,
                    'message' => 'Nonce is invalid'
                ), 400);
            }
        } else {
            if (!$is_valid) {
                return new WP_REST_Response(
                    array(
                        'status' => 403,
                        'response' => array(
                            'message' => 'Nonce is invalid'
                        )
                    )
                );
                wp_die('', 400);
            }
        }
    }

    public static function get_param($param, $is_esc = true) {
        if (!isset($_REQUEST[$param]) || empty($_REQUEST[$param])) {
            return '';
        }

        $val = $_REQUEST[$param];

        if (gettype($val) === 'string') {
            $val = trim($val);
            $val = stripslashes($val);
            $val = $is_esc ? esc_html($val) : $val;
        }

        return $val;
    }
}