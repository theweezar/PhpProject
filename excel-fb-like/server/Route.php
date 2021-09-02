<?php

class Route {
    public static $routes = array();

    public static function get($uri, $callback) {
        $uri = substr($uri, 0, 1) == '/' ? $uri : '/'.$uri;
        self::$routes[$uri] = array(
            'method' => 'GET',
            'callback' => $callback
        );
    }

    public static function post($uri, $callback) {
        $uri = substr($uri, 0, 1) == '/' ? $uri : '/'.$uri;
        self::$routes[$uri] = array(
            'method' => 'POST',
            'callback' => $callback
        );
    }
}
