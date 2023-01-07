<?php

function uploadFile($file) {
  $time = floor(microtime(true) * 1000);
  $fileName =  'img/' . $time . '-' . basename($file['name']);
  move_uploaded_file($file['tmp_name'], "../" .$fileName);
  return $fileName;
}