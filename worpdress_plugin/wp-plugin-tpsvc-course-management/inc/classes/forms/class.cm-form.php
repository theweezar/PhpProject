<?php

class CM_Form {
    /**
     * Form control type
     */
    public static $type_text = 'text';
    public static $type_hidden = 'hidden';
    public static $type_file = 'file';
    public static $type_date = 'date';
    public static $type_select = 'select';
    public static $type_text_area = 'textarea';

    /**
     * Form data
     */
    private $form;

    protected function set_form($form_config = array()) {
        /**
         * $this->form = array(
         *      '<form_control_id>' => array(
         *          'label' => '<Change label here>',
         *          'type' => '<Change type here>',
         *          'required' => <true/false>,
         *          'custom' => array(
         *              'placeholder' => 'Example: 202203_202205_english_toeic_1',
         *              'data-text' => 'hello world'
         *           )
         *      )
         * )
         */
        $this->form = $form_config;

        /**
         * Parse attributes for each form-control
         */
        foreach ($this->form as $form_control_id => $form_control) {
            $this->form[$form_control_id]['attributes'] = $this->get_form_control_custom_attribute($form_control_id);
        }
    }

    /**
     * Set the form control value
     */
    public function set_form_value($form_control_id, $form_value) {
        if (!isset($this->form[$form_control_id])) return CM_Error_Status::$status_form_control_not_exist;

        $this->form[$form_control_id]['value'] = $form_value;
    }

    /**
     * Set the form control selected value
     */
    public function set_form_selected_value($form_control_id, $selected_value) {
        if (!isset($this->form[$form_control_id])) return CM_Error_Status::$status_form_control_not_exist;

        $this->form[$form_control_id]['selected_value'] = $selected_value;
    }

    /**
     * Set the form control values based on the provided array
     */
    public function set_form_values($form_control_array_value = array()) {
        foreach ($form_control_array_value as $form_control_id => $value) {
            if (!isset($this->form[$form_control_id])) continue;

            // $filtered_value = trim(esc_html($value));
            $filtered_value = trim($value);
            
            $this->set_form_value($form_control_id, $filtered_value);
        }
    }

    /**
     * Return the form controll based on the given from control id
     * 
     * @return array The form control array
     */
    public function get_form_control($form_control_id) {
        return $this->form[$form_control_id];
    }

    /**
     * Get the form
     * 
     * @return array The form
     */
    public function get_form() {
        return $this->form;
    }

    /**
     * Parse the form control custom config to the HTML attribute string and return it
     * 
     * @return string the HTML attribute string
     */
    public function get_form_control_custom_attribute($form_control_id) {
        $form_control = $this->form[$form_control_id];

        if (!isset($form_control['custom']) || gettype($form_control['custom']) !== 'array') return '';

        $form_control_custom_attrs = $form_control['custom'];
        $html_string = '';

        foreach ($form_control_custom_attrs as $key => $value) {
            $html_string = $key . '=' . '"' . $value . '" ' . $html_string; 
        }

        return $html_string;
    }

    /**
     * Parse locale to options
     * 
     * @return array The locale options
     */
    protected function get_locale_options() {
        $locale_options = array();

        foreach (Custom_Locale::$locales as $locales_id => $locales_name) {
            array_push($locale_options, array(
                'value' => $locales_id,
                'html_value' => $locales_name
            ));
        }

        return $locale_options;
    }

    /**
     * Validate the form based on the input form-control array
     * 
     * @return string Return status string in CM_Error_Status
     */
    public function validate() {
        $status = array(
            'success' => false
        );

        foreach ($this->form as $form_control_id => $form_control) {
            if (!isset($form_control)) return CM_Error_Status::$status_form_control_not_exist;

            // if ($form_control['required'] && !isset($form_control['value'])) {
            //     $status['error_code'] = 
            //     return 
            // }
        }
    }

    /**
     * Render the HTML form control <select>
     */
    public static function render_form_control_select($form_control_id, $form_control_config) {
        ?>
        <div class="form-group <?php echo $form_control_id ?>">
            <label for="<?php echo $form_control_id ?>"><?php echo $form_control_config['label'] ?></label>
            <select name="<?php echo $form_control_id ?>" class="form-control <?php echo isset($form_control_config['readonly_when_has_value']) && isset($form_control_config['value']) ? 'always-readonly' : '' ?>"
                id="<?php echo $form_control_id ?>"
                data-selected-value="<?php echo $form_control_config['selected_value']; ?>"
                <?php echo $form_control_config['required'] ? 'required':''; ?>
                <?php echo $form_control_config['attributes'] ?>
                <?php echo isset($form_control_config['readonly_when_has_value']) && isset($form_control_config['value']) ? 'readonly' : '' ?>
            >
                <?php
                if (isset($form_control_config['options']) && gettype($form_control_config['options']) === 'array') {
                    foreach ($form_control_config['options'] as $idx => $option) {
                        ?>
                        <option <?php echo strcmp($form_control_config['selected_value'], $option['value']) === 0 ? 'selected' : ''; ?> 
                            data-index="<?php echo $idx; ?>" 
                            value="<?php echo $option['value'] ?? ''; ?>"
                        >
                            <?php echo $option['html_value'] . ' (' . $option['value'] . ')'; ?>
                        </option>
                        <?php
                    }
                }
                ?>
            </select>
            <div class="invalid-message">
                <?php echo $form_control_config['invalid_message'] ?? ''; ?>
            </div>
        </div>
        <?php
    }

    /**
     * Render the HTML form control <input type="file">
     */
    public static function render_form_control_file($form_control_id, $form_control_config) {
        ?>
        <div class="form-group <?php echo $form_control_id ?>">
            <label for="<?php echo $form_control_id ?>"><?php echo $form_control_config['label'] ?></label>

            <?php
            // Show the images
            $file_info = pathinfo($form_control_config['value']);
            if (in_array(strtolower($file_info['extension']), array('jpg', 'png', 'jpeg'))) {
                ?>
                <div class="mb-1 media-preview">
                    <img src="<?php echo $form_control_config['value']; ?>" alt="" height="120" width="auto">
                </div>
                <?php
            }
            ?>

            <input type="text" class="form-control"
                name="<?php echo $form_control_id ?>"
                id="<?php echo $form_control_id ?>"
                value="<?php echo $form_control_config['value'] ?? '' ?>"
                data-restore-value="<?php echo $form_control_config['value'] ?? '' ?>"
                placeholder="Path"
                readonly
                <?php echo $form_control_config['required'] ? 'required':''; ?>
                <?php echo $form_control_config['attributes'] ?>
                <?php echo isset($form_control_config['accept']) ? 'accept="' . $form_control_config['accept'] . '"' : '' ?>
            >

            <?php
            // If the form control type is file, the file element will be displayed
            if (strcmp($form_control_config['type'], CM_Form::$type_file) === 0) {
                ?>
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-warning btn-restore ml-2">Restore file</button>

                    <!-- Pick file open modal -->
                    <button type="button" class="btn btn-primary ml-2" data-toggle="modal" data-target="#media-file-picker">
                        Choose
                    </button>
                </div>
                <?php
            }
            ?>

            <div class="invalid-message">
                <?php echo $form_control_config['invalid_message'] ?? ''; ?>
            </div>
        </div>
        <?php
    }

    /**
     * Render the HTML form control <input>
     */
    public static function render_form_control_input($form_control_id, $form_control_config) {
        ?>
        <div class="form-group <?php echo $form_control_id ?>">
            <label for="<?php echo $form_control_id ?>"><?php echo $form_control_config['label'] ?></label>

            <input type="<?php echo $form_control_config['type'] ?>" class="form-control <?php echo isset($form_control_config['readonly_when_has_value']) && isset($form_control_config['value']) ? 'always-readonly' : '' ?>"
                name="<?php echo $form_control_id ?>"
                id="<?php echo $form_control_id ?>"
                value="<?php echo $form_control_config['value'] ?? '' ?>"
                <?php echo $form_control_config['required'] ? 'required':''; ?>
                <?php echo $form_control_config['attributes'] ?>
                <?php echo isset($form_control_config['readonly_when_has_value']) && isset($form_control_config['value']) ? 'readonly' : '' ?>
            >

            <div class="invalid-message">
                <?php echo $form_control_config['invalid_message'] ?? ''; ?>
            </div>
        </div>
        <?php
    }

    /**
     * Render the HTML form control <textarea>
     */
    public static function render_form_control_text_area($form_control_id, $form_control_config) {
        ?>
        <div class="form-group <?php echo $form_control_id ?>">
            <label for="<?php echo $form_control_id ?>"><?php echo $form_control_config['label'] ?></label>
            <textarea class="form-control <?php echo isset($form_control_config['readonly_when_has_value']) && isset($form_control_config['value']) ? 'always-readonly' : '' ?>"
                id="<?php echo $form_control_id ?>"
                name="<?php echo $form_control_id ?>" rows="8"
                <?php echo $form_control_config['required'] ? 'required':''; ?>
                <?php echo $form_control_config['attributes'] ?>
                <?php echo isset($form_control_config['readonly_when_has_value']) && isset($form_control_config['value']) ? 'readonly' : '' ?>
            ><?php echo $form_control_config['value'] ?? '' ?></textarea>
            <div class="invalid-message">
                <?php echo $form_control_config['invalid_message'] ?? ''; ?>
            </div>
        </div>
        <?php
    }
}
