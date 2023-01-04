<?php

require_once __DIR__ . "/../dal/dal.php";

function getSizes() {
  $sizes = get_rows("SELECT * FROM sizes");
  return $sizes;
}