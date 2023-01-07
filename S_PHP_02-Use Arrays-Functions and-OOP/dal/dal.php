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

function getSingleRow($query) {
  $row = false;
  $con = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  if ($con->connect_error) {
    return false;
  }

  $q = $con->query($query);
  $row = $q->fetch_assoc();
  $con->close();

  return $row;
}


function execute($q) {
  $con = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  if ($con->connect_error) {
    return false;
  }

  $done = $con->query($q);
  if (!$done) {
    return false;
  }

  $con->close();
  return true;
}