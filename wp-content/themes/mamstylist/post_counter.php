<?php
/**
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gramercy-Village
 */

$middleschool = $_POST['middleschool'];
$highschool = $_POST['highschool'];
$situation_params = $_POST['situation'];
$genre_params = $_POST['genre'];
$price_params = $_POST['price'];

$args = [
    'post_type' => 'product',
    'post_status' => 'publish',
];

$tax_query = [];

if($middleschool) {
    $tax_query[] = [
        'taxonomy' => 'product_cat',
        'field' => 'slug',
        'terms' => 'middleschool',
    ];
}

if($highschool) {
    $tax_query[] = [
        'taxonomy' => 'product_cat',
        'field' => 'slug',
        'terms' => 'highschool',
    ];
}

if($situation_params) {
    $tax_query[] = [
        'taxonomy' => 'product_cat',
        'field' => 'slug',
        'terms' => $situation_params,
    ];
}

if($genre_params) {
    $tax_query[] = [
        'taxonomy' => 'product_cat',
        'field' => 'slug',
        'terms' => $genre_params,
    ];
}

if($price_params) {
    $tax_query[] = [
        'taxonomy' => 'product_cat',
        'field' => 'slug',
        'terms' => $price_params,
    ];
}

if(!empty($tax_query)) {
    $args['tax_query'] = $tax_query;
}

$product_query  = new WP_Query( $args );

// $total_counts = $product_query->found_posts;

$response = array(
    'posts_count' => 'sdfsdfasdf',
    'message' => 'Data received and processed successfully!',
);

echo "sdgsgsergrstg";

// Process the received data as needed
// ...
?>