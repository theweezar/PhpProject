<?php

class Request {
    public function dump($controller = null, $method = null){
        $argv = array(
            'controller' => $controller,
            'method' => $method
        );
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $argv['request_method'] = 'GET';
            $argv['params'] = $_GET;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $argv['request_method'] = 'POST';
            $argv['params'] = $_POST;

            foreach (array_keys($_FILES) as $key) {
                /**
                 * 0 means the image is passed
                 * Another means something is wrong
                 */
                if ($_FILES[$key]['error'] === 0) {
                    $argv['files'][$key] = $_FILES[$key];
                }
                else $argv['files'][$key] = null;
            }
        }
        return [$argv];
    }
}