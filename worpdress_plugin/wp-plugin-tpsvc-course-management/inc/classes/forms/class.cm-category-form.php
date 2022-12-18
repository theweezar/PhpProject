<?php

class CM_Category_Form extends CM_Form {
    public function __construct() {
        $this->set_form(array(
            CM_Category_Attribute_Table::$locale => array(
                'label' => 'Locale',
                'type' => CM_Form::$type_select,
                'required' => true,
                'options' => $this->get_locale_options()
            ),
            CM_Category_Table::$category_id => array(
                'label' => 'Category ID',
                'type' => CM_Form::$type_text,
                'required' => true,
                'readonly_when_has_value' => true
            ),
            CM_Category_Attribute_Table::$category_name => array(
                'label' => 'Category name',
                'type' => CM_Form::$type_text,
                'required' => false
            )
        ));
    }
}
