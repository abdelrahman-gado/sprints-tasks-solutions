<?php


require_once __DIR__ . '/../dal/dal.php';

function getSizes()
{
  return get_rows("SELECT * FROM sizes");
}
