<?php

class CM_Student_Controller {
    /**
	 * Render the Admin page to manage student
	 */
    public static function route_index() {
        CM_Template::render('student/student.php');
    }

    /**
     * Route: Submit register student
     * 
     * @return WP_REST_Response WP_REST_Response
     */
    public static function route_register_student($data) {
        $params = $data->get_params();
        $nonce = $params['_wpnonce'];

        /**
         * Verify nonce
         */
        if (!wp_verify_nonce($nonce, 'wp_rest')) {
            return new WP_REST_Response(
                array(
                    'status' => 403,
                    'response' => array(
                        'message' => 'Nonce is invalid'
                    )
                )
            );
        }

        $student = array(
            CM_Student_Table::$student_id => null,
            CM_Student_Table::$email => $params['email'],
            CM_Student_Table::$student_password => $params['student_password'],
            CM_Student_Table::$first_name => $params['first_name'],
            CM_Student_Table::$last_name => $params['last_name'],
            CM_Student_Table::$gender => $params['gender'],
            CM_Student_Table::$birth_day => '1987-12-15',
            CM_Student_Table::$phone_number => $params['phone_number'],
            CM_Student_Table::$address => null,
            CM_Student_Table::$citizen_identification => $params['citizen_identification'],
            CM_Student_Table::$created_at => date("Y-m-d h:i:s")
        );

        $response = array(
            'success' => false
        );

        /**
         * Compare password and confirm password. Then hash the password
         */
        if (strcmp($student[CM_Student_Table::$student_password], $params['student_confirm_password']) !== 0) {
            $response['message'] = 'Password is incorrect.';
            return new WP_REST_Response($response);
        }
        
        
        /**
         * Check 3 columns whether their value existed or not
         */
        if (CM_Student_Mgr::is_column_value_exist(CM_Student_Table::$email, $student[CM_Student_Table::$email])) {
            $response['message'] = 'Email existed.';
            return new WP_REST_Response($response);
        }

        if (CM_Student_Mgr::is_column_value_exist(CM_Student_Table::$phone_number, $student[CM_Student_Table::$phone_number])) {
            $response['message'] = 'Phone number existed.';
            return new WP_REST_Response($response);
        }

        if (CM_Student_Mgr::is_column_value_exist(CM_Student_Table::$citizen_identification, $student[CM_Student_Table::$citizen_identification])) {
            $response['message'] = 'Citizen Identification existed.';
            return new WP_REST_Response($response);
        }

        $result_after_insert = CM_Student_Mgr::create_student($student);

        global $wpdb;

        $response['success'] = $result_after_insert;
        $response['message'] = $wpdb->last_error;

        return new WP_REST_Response(array(
            'response' => $response
        ));
    }

    public static function route_login_student($data) {
        $params = $data->get_params();
        $nonce = $params['_wpnonce'];

        /**
         * Verify nonce
         */
        if (!wp_verify_nonce($nonce, 'wp_rest')) {
            return new WP_REST_Response(
                array(
                    'status' => 403,
                    'response' => array(
                        'message' => 'Nonce is invalid'
                    )
                )
            );   
        }

        $status = CM_Student_Mgr::create_credential($params['email'], $params['student_password']);
        $response = array(
            'success' => false,
            'status' => $status
        );

        if (strcmp($status, CM_Error_Status::$status_login_incorrect_email) === 0
            || strcmp($status, CM_Error_Status::$status_login_incorrect_password) === 0) {
            $response['message'] = 'Wrong email or password';
        } else {
            $response['success'] = true;
            $response['redirect_url'] = get_home_url();
        }

        return new WP_REST_Response($response);
    }
}