<?php

require_once __DIR__ . "/../dal/dal.php";

function getColors() {
  $colors = get_rows("SELECT * FROM colors");
  return $colors;
}