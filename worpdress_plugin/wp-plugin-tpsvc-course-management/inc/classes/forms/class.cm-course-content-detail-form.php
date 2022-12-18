<?php 

class CM_Course_Content_Detail_Form extends CM_Form {
    public function __construct() {
        $this->set_form(array(
            CM_Course_Content_Detail_Table::$course_content_detail_id => array(
                'label' => 'Course content ID',
                'type' => CM_Form::$type_text,
                'required' => true,
                'readonly_when_has_value' => true
            ),
            CM_Course_Content_Detail_Table::$course_thumbnail_url => array(
                'label' => 'Course thumbnail (File)',
                'type' => CM_Form::$type_file,
                'accept' => 'image/png, image/jpeg, image/jpg',
                'required' => false
            ),
            CM_Course_Content_Detail_Table::$locale => array(
                'label' => 'Locale',
                'type' => CM_Form::$type_select,
                'required' => true,
                'options' => $this->get_locale_options()
            ),
            CM_Course_Content_Detail_Table::$short_description => array(
                'label' => 'Short description',
                'type' => CM_Form::$type_text_area,
                'required' => false
            ),
            CM_Course_Content_Detail_Table::$about_this_course => array(
                'label' => 'About this course content',
                'type' => CM_Form::$type_text_area,
                'required' => false
            ),
            CM_Course_Content_Detail_Table::$what_you_will_learn => array(
                'label' => 'What will students learn? ',
                'type' => CM_Form::$type_text_area,
                'required' => false
            ),
            CM_Course_Content_Detail_Table::$additional_content => array(
                'label' => 'Additional content (This content will be placed in the bottom of the course detail page)',
                'type' => CM_Form::$type_text_area,
                'required' => false
            )
        ));
    }
}