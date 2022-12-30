<?php
foreach ([1, 2, 3, 4, 5] as $r) {
  if ($product["rating"] >= $r) {
    echo '<small class="fa fa-star text-primary mr-1"></small>';
  } elseif (abs($product["rating"] - $r) === 0.5) {
    echo '<small class="fa fa-star-half-alt text-primary mr-1"></small>';
  } else {
    echo '<small class="far fa-star text-primary mr-1"></small>';
  }
}
