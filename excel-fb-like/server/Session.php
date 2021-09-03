<?php

session_start();

class Session {
    public static function put(array $session) {
        foreach (array_keys($session) as $key) {
            $_SESSION[$key] = $session[$key];
        }
    }

    public static function remove(string $key) {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    public static function get(string $key) {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public static function all() {
        return $_SESSION;
    }

    public static function destroy() {
        session_destroy();
    }
}
