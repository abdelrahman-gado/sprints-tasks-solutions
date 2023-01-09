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

function get_row($q) {
  $row = null;
  $con = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  if ($con->connect_error) {
    return null;
  }

  $q = $con->query($q);
  if (!$q) {
    return $row;
  }
  $row = $q->fetch_assoc();
  $con->close();
  return $row;
}


function execute($q)
{
  $result = false;
  $con = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  if ($con->connect_error) {
    return $result;
  }

  $result = $con->query($q);

  $con->close();
  return $result;
}

function get_user($username, $password)
{
  $row = null;
  $con = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  if ($con->connect_error) {
    return null;
  }

  $stmt = $con->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
  $stmt->bind_param("ss", $username, $password);
  $q = $stmt->execute();
  if (!$q) {
    return null;
  }

  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  if (!$row) {
    return null;
  }
  $con->close();
  
  return $row;
}

