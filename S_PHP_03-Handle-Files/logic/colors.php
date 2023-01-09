<?php


require_once  __DIR__ . '/../dal/dal.php';

function getColors()
{
  return get_rows("SELECT * FROM colors");
}
