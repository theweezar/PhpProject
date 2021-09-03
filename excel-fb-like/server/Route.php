<?php

class Route {
    public static $routes = array();

    public static function get($uri, ...$chains) {
        $uri = substr($uri, 0, 1) == '/' ? $uri : '/'.$uri;
        if (isset(self::$routes['GET'.$uri])) {
            throw new Exception('Route '.'GET'.$uri.' is existed', 500);
        } else {
            self::$routes['GET'.$uri] = array(
                'method' => 'GET',
                'chains' => $chains
            );
        }
    }

    public static function post($uri, ...$chains) {
        $uri = substr($uri, 0, 1) == '/' ? $uri : '/'.$uri;
        if (isset(self::$routes['POST'.$uri])) {
            throw new Exception('Route '.'POST'.$uri.' is existed', 500);
        } else {
            self::$routes['POST'.$uri] = array(
                'method' => 'POST',
                'chains' => $chains
            );
        }
    }
}
