<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'online-shop');
define('DB_PASSWORD', 'O@nline123');
define('DB_NAME', 'shop');

function get_rows($q) {
  $rows = [];
  $con = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  if ($con->connect_error) {
    return [];
  }

  $q = $con->query($q);
  while ($row = $q->fetch_assoc()) {
    array_push($rows, $row);
  }

  $con->close();
  return $rows;
}


function execute($q) {
  $con = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  if ($con->connect_error) {
    return [];
  }

  $done = $con->query($q);
  if (!$done) {
    return false;
  }

  $con->close();
  echo "Hello";
  return true;
}