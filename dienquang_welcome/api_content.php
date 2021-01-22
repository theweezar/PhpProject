<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/database/web_content.php');

$web_content = new WebContent();

class Fetcher{
  
  private $web_content = null;

  public function __construct() {
    $this->web_content = new WebContent();
  }

  public function fetch_content_with_name($name){
    $result = $this->web_content->load_content_with_name($name);
    if ($result != null){
      $content = mysqli_fetch_assoc($result);
      return $content["content"];
    }
    else return "";
  }

  public function fetch_thumbnail_with_name($name){
    $result = $this->web_content->load_content_with_name($name);
    if ($result != null){
      $content = mysqli_fetch_assoc($result);
      $result = $this->web_content->load_thumbnail($content['id']);
      if ($result != null) return mysqli_fetch_assoc($result)['thumbnail_link'];
      else return "";
    }
    else return "";
  }

  public function fetch_all_embed_thumbnail(){
    $result = $this->web_content->load_all_embed_join_thumbnail();
    $data = array();
    if ($result != null){
      for($i = 0; $i < mysqli_num_rows($result); $i++){
        $embed = mysqli_fetch_assoc($result);
        array_push($data,[
          "thumbnail_link" => $embed["thumbnail_link"],
          "iframe_link" => $embed["content"]
        ]);
      }
    }
    return $data;
  }

  // public function fetch_
}

$fetcher = new Fetcher();

$result = array(
  "logo_1" => $fetcher->fetch_content_with_name("logo_1"),
  "logo_2" => $fetcher->fetch_content_with_name("logo_2"),
  "logo_3" => $fetcher->fetch_content_with_name("logo_3"),
  "slogan" => $fetcher->fetch_content_with_name("slogan"),
  "introduce" => $fetcher->fetch_content_with_name("introduce"),
  "more" => $fetcher->fetch_content_with_name("more"),
  "nav_1_trang_chu" => $fetcher->fetch_content_with_name("nav_1_trang_chu"),
  "nav_2_ngon_ngu" => $fetcher->fetch_content_with_name("nav_2_ngon_ngu"),
  "nav_3_lien_he" => $fetcher->fetch_content_with_name("nav_3_lien_he"),
  "company_name" => $fetcher->fetch_content_with_name("company_name"),
  "address" => $fetcher->fetch_content_with_name("address"),
  "hotline" => $fetcher->fetch_content_with_name("hotline"),
  "email" => $fetcher->fetch_content_with_name("email"),
  "website" => $fetcher->fetch_content_with_name("website"),
  "introduce_en" => $fetcher->fetch_content_with_name("introduce_en"),
  "more_en" => $fetcher->fetch_content_with_name("more_en"),
  "embed" => $fetcher->fetch_all_embed_thumbnail()
);

echo json_encode($result);