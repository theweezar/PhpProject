<?php

class CM_Student_Mgr {

    /**
	 * Generate the student id based on today and the student amount
	 *
	 * @return string The next student id
	 */
    public static function get_new_student_id() {
        global $wpdb;
        $today = date("Ymd");

        $stmt = $wpdb->prepare('
        SELECT * FROM ' . CM_Student_Table::table_name() . ' WHERE ' . CM_Student_Table::$student_id . ' LIKE %%s%
        ', array($today));

        $result = $wpdb->get_results($stmt, ARRAY_A);
        $new_order = count($result) + 1;

        return $today.$new_order;
    }

    /**
     * Check if the given column value exists
     * 
     * @return bool Return true if the give column value existed in database
     */
    public static function is_column_value_exist($column_name, $value) {
        global $wpdb;
        $stmt = $wpdb->prepare('
        SELECT * FROM ' . CM_Student_Table::table_name() . ' WHERE ' . $column_name . ' = %s
        ', array($value));
        $result = $wpdb->get_results($stmt, ARRAY_A);
        return count($result) !== 0;
    }

    public static function get_student_by_column($column_name, $value) {
        global $wpdb;

        $stmt = $wpdb->prepare('
        SELECT * FROM ' . CM_Student_Table::table_name() . ' WHERE ' . $column_name . ' = %s
        ', array($value));

        $result = $wpdb->get_results($stmt, ARRAY_A);
        return $result;
    }

    public static function create_credential($email, $password) {
        $students = CM_Student_Mgr::get_student_by_column(CM_Student_Table::$email, $email);

        if (count($students) === 0) {
            return CM_Error_Status::$status_login_incorrect_email;
        }

        $student = $students[0];
        $hash_password = password_hash($password, PASSWORD_DEFAULT);

        $is_valid = password_verify($hash_password, $student['student_password']);

        if (!$is_valid) {
            return CM_Error_Status::$status_login_incorrect_password;
        }

        unset($student[CM_Student_Table::$student_password]);

        Session::put(array(
            'current_student' => $student
        ));

        return CM_Status::$status_login_successfully;
    }

    /**
     * Create new student
     * 
     * @return bool Return true if insert successfully
     */
    public static function create_student($student = array()) {
        global $wpdb;

        $clone_student = $student;
        $clone_student[CM_Student_Table::$student_id] = CM_Student_Mgr::get_new_student_id();
        $clone_student[CM_Student_Table::$student_password] = password_hash($clone_student[CM_Student_Table::$student_password], PASSWORD_DEFAULT);

        return $wpdb->insert(CM_Student_Table::table_name(), $clone_student);
    }
}