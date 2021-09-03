<?php

class Route {
    public static $routes = array();

    public static function get($uri, ...$chains) {
        $uri = substr($uri, 0, 1) == '/' ? $uri : '/'.$uri;
        self::$routes['GET'.$uri] = array(
            'method' => 'GET',
            'chains' => $chains
        );
    }

    public static function post($uri, ...$chains) {
        $uri = substr($uri, 0, 1) == '/' ? $uri : '/'.$uri;
        self::$routes['POST'.$uri] = array(
            'method' => 'POST',
            'chains' => $chains
        );
    }
}
