<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/database/web_content.php');

$id = $_POST["id"];

$web_content = new WebContent();

$web_content->delete_content($id);
$web_content->delete_thumbnail($id);
