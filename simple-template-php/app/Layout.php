<?php

class Layout {
    public function __construct(string $content = '', string $title = 'Document', string $layout = 'layout.php') {
        include $_SERVER['DOCUMENT_ROOT'].'/layouts/'.$layout;
    }

    public static $layout;
    public static $title;

    public static function start(string $title = 'Document', string $layout = 'layout.php') {
        self::$layout = $layout;
        self::$title = $title;
        ob_start();
    }

    public static function end() {
        $content = ob_get_clean();
        $layout = new Layout($content, self::$title, self::$layout);
    }
}