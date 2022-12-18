<?php

class CM_Course_Form extends CM_Form {
    public function __construct() {
        $this->set_form(array(
            CM_Course_Table::$course_id => array(
                'label' => 'Course ID',
                'type' => CM_Form::$type_text,
                'required' => true,
                'readonly_when_has_value' => true,
                // 'custom' => array(
                //     'placeholder' => 'Example: 202203_202205_english_toeic_1'
                // )
            ),
            CM_Course_Table::$course_name => array(
                'label' => 'Course name',
                'type' => CM_Form::$type_text,
                'required' => true
            ),
            CM_Course_Table::$price => array(
                'label' => 'Price',
                'type' => CM_Form::$type_text,
                'required' => true
            ),
            CM_Course_Table::$discount_price => array(
                'label' => 'Discount price',
                'type' => CM_Form::$type_text,
                'required' => false
            ),
            CM_Course_Table::$number_of_student => array(
                'label' => 'Number of student',
                'type' => CM_Form::$type_text,
                'required' => true
            ),
            CM_Course_Table::$start_register_date => array(
                'label' => 'Start register date',
                'type' => CM_Form::$type_date,
                'required' => false
            ),
            CM_Course_Table::$end_register_date => array(
                'label' => 'End register date',
                'type' => CM_Form::$type_date,
                'required' => false
            ),
            CM_Course_Table::$start_date => array(
                'label' => 'Start date',
                'type' => CM_Form::$type_date,
                'required' => false
            ),
            CM_Course_Table::$end_date => array(
                'label' => 'End date',
                'type' => CM_Form::$type_date,
                'required' => false
            ),
            CM_Course_Table::$level => array(
                'label' => 'Level',
                'type' => CM_Form::$type_text,
                'required' => false
            ),
            CM_Course_Table::$course_content_detail_id => array(
                'label' => 'Course content ID',
                'type' => CM_Form::$type_text,
                'required' => false
            ),
            CM_Course_Table::$instructor_name => array(
                'label' => 'Instructor name',
                'type' => CM_Form::$type_text,
                'required' => true
            )
        ));
    }
}