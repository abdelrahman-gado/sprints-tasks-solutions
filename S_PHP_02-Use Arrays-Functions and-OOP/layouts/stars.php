<?php

function getHTMLStars($rating) {

  $HTMLStars = "";

  foreach ([1, 2, 3, 4, 5] as $r) {
    if ($rating >= $r) {
      $HTMLStars .= '<small class="fa fa-star text-primary mr-1"></small>';
    } elseif (abs($rating - $r) === 0.5) {
      $HTMLStars .=  '<small class="fa fa-star-half-alt text-primary mr-1"></small>';
    } else {
      $HTMLStars .= '<small class="far fa-star text-primary mr-1"></small>';
    }
  }

  return $HTMLStars;
}


