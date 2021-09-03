<?php

class Request {
    public $params;
    
    public function __construct() {
        $params = array();
        $this->parseParams();
    }
    
    private function parseParams(){
        if ($this->isGet()) {
            $this->params = $_GET;
        }
        if ($this->isPost()) {
            $this->params = $_POST;

            // foreach (array_keys($_FILES) as $key) {
            //     /**
            //      * 0 means the image is passed
            //      * Another means something is wrong
            //      */
            //     if ($_FILES[$key]['error'] === 0) {
            //         $argv['files'][$key] = $_FILES[$key];
            //     }
            //     else $argv['files'][$key] = null;
            // }
        }
        if (count($this->params) != 0) {
            foreach ($this->params as $key => $param) {
                $param = htmlspecialchars(trim($param), ENT_QUOTES, 'UTF-8');
            }
        }
    }

    public function getParams() {
        return $this->params;
    }

    public function isGet() {
        return METHOD == 'GET';
    }

    public function isPost() {
        return METHOD == 'POST';
    }

    public function validate(array $options) {
        foreach ($options as $key => $option) {
            $input = isset($this->params[$key]) ? $this->params[$key] : '';
            $this->params[$key] = $input;
            foreach ($option as $index => $type) {
                if (strcmp($type, 'required') == 0) {
                    if (strlen($input) == 0) {
                        return array(
                            'valid' => false,
                            'message' => 'Vui lòng điền đầy đủ thông tin'
                        );
                    }
                }
                if (strcmp($type, 'number') == 0) {
                    if (!is_numeric($input)) {
                        return array(
                            'valid' => false,
                            'message' => 'Vui lòng điền thông tin dạng số'
                        );
                    }
                }
            }
        }
        return array(
            'valid' => true,
            'message' => 'PASS'
        );
    }
}