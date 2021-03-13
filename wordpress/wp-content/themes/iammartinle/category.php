<?php
/**
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::context();
$timber_post     = new Timber\Post();
$context['post'] = $timber_post;
$totalPages = get_option('posts_per_page');
$url = get_queried_object();

$context['categories'] = Timber::get_terms([
    'post_type' =>'post',
    'post_status' =>'publish',
    'taxonomy' => 'category',
    'slug' => $url->slug,
    'orderby' => 'menu_order',
    'order' => 'DESC',
    'posts_per_page' => $totalPages,
]);
$context['related_posts'] = Timber::get_posts([
    'post_type' =>'post',
    'post_status' =>'publish',
    'order' => 'DESC',
    'orderby' => 'date',
    'posts_per_page' => $totalPages,
    'cat' => ( get_queried_object() )->term_id
]);

Timber::render( array( 'page-' . $timber_post->post_name . '.twig', 'template-articles.twig' ), $context );
