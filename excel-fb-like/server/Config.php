<?php

define('ENV', 'development');
define('SESSION', $_SERVER['DOCUMENT_ROOT'].'/server/Session.php');
define('URL', $_SERVER['DOCUMENT_ROOT'].'/server/Url.php');
define('ROUTE', $_SERVER['DOCUMENT_ROOT'].'/server/Route.php');
define('APP', $_SERVER['DOCUMENT_ROOT'].'/server/App.php');
define('REQUEST', $_SERVER['DOCUMENT_ROOT'].'/server/Request.php');
define('RESPONSE', $_SERVER['DOCUMENT_ROOT'].'/server/Response.php');
define('NEXT', $_SERVER['DOCUMENT_ROOT'].'/server/Next.php');
define('LAYOUT', $_SERVER['DOCUMENT_ROOT'].'/server/Layout.php');
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('URI', $_SERVER['REQUEST_URI']);
define('METHOD', $_SERVER['REQUEST_METHOD']);
define('DATABASE', $_SERVER['DOCUMENT_ROOT'].'/databases/Database.php');