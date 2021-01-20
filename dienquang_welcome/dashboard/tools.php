<?php

function get_random_string($length){
  $str = "";
  for($i = 0; $i < $length; $i+=1){
    $str = $str.chr(rand(97,122));
  }
  return $str;
}