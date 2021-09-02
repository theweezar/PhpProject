<?php
require($_SERVER['DOCUMENT_ROOT'].'/server/Config.php');
require($_SERVER['DOCUMENT_ROOT'].'/server/Server.php');

$server = new Server();
$server->route();