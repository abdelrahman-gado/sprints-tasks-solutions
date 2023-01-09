<?php

function getStars($rating)
{
  $stars = "";
  foreach ([1, 2, 3, 4, 5] as $r) {
    if ($rating >= $r) {
      $stars .= '<small class="fa fa-star text-primary mr-1"></small>';
    } elseif (abs($rating - $r) === 0.5) {
      $stars .=  '<small class="fa fa-star-half-alt text-primary mr-1"></small>';
    } else {
      $stars .=  '<small class="far fa-star text-primary mr-1"></small>';
    }
  }

  return $stars;
}
