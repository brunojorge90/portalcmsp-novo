<?php
$automatico = get_field("automatico");
if ($automatico) {
    $args = [
        'post_type' => ['slider-home'],
        'showposts' => 5,
    ];
    $featuredQuery2 = new WP_Query($args);
}
if(count($featuredQuery2->posts) === 1) {
    include 'tema1.php';
}

if(count($featuredQuery2->posts) === 2) {
    include 'tema2.php';
}


if(count($featuredQuery2->posts) === 3) {
    include 'tema3.php';
}


if(count($featuredQuery2->posts) >= 4) {
    include 'tema4.php';
}