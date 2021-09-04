<?php

class Url {
    public static function abs(string $path) {
        return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http").'://'.$_SERVER['HTTP_HOST'].'/'.$path;
        // return "https://fb.reiplex.com/".$path;
    }

    public static function build(string $path, $params = array()) {
        $querystring = '';
        if (count($params) != 0) {
            $querystring = http_build_query($params);
            $path = $path.'?'.$querystring;
        }
        return $path;
    }
}