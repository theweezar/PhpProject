<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/database/web_content.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/dashboard/tools.php');

$web_content = new WebContent();

$name = $_POST['name'];
$iframe = $_POST['iframe'];

// insert content
$web_content->insert_content($name, $iframe, 3);

// lấy cái content embed mới nhất ra để set id cho thumbnail
$newest_embed = $web_content->get_newest_embed_content();
$newest_embed_id = $newest_embed != null ? mysqli_fetch_assoc($newest_embed)["id"] : null;

// Lưu thumbnail trong database trước
if ($newest_embed_id != null) $web_content->insert_thumbnail($newest_embed_id,"");

// return cái embed_id mới ra và ajax tiếp tục tới save_thumbnail.php nếu có upload ảnh
$response = [
  "newest_embed_id" => $newest_embed_id
];
echo json_encode($response);