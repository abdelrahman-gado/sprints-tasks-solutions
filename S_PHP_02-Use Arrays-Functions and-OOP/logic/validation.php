<?php

function validate($arr, $val)
{
  if (!isset($arr[$val])) {
    return false;
  }

  return htmlspecialchars(trim(stripslashes($arr[$val])));
}


function validateEmail($arr, $val)
{
  $email = validate($arr, $val);
  if (!$email) {
    return false;
  }

  return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validateNumber($arr, $value, $max, $min = 0) {
  if (!isset($arr[$value])) {
    return false;
  }

  if ($arr[$value] > $max || $arr[$value] < $min) {
    return false;
  }

  return (float) $arr[$value];
}


function validateFile($arr, $value, $allowedType, $maxSize = 2097152) {

  if (!isset($arr[$value])) {
    return false;
  }

  if ($arr[$value]['error'] !== 0) {
    return false;
  }

  if (!is_uploaded_file($arr[$value]['tmp_name'])) {
    return false;
  }

  if (!str_contains($arr[$value]['type'], $allowedType)) {
    return false;
  }

  if ($arr[$value]['size'] > $maxSize) {
    return false;
  }

  return $arr[$value];
}