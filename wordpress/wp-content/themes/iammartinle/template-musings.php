<?php
/**
 * Template Name: Musings
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::context();
$totalPages = get_option('posts_per_page');

$timber_post     = new Timber\Post();
$context['post'] = $timber_post;
$context['musing_posts'] = Timber::get_posts([
    'post_type' =>'musings',
    'post_status' =>'publish',
    'order' => 'DESC',
    'orderby' => 'date',
    'posts_per_page' => $totalPages,
]);
Timber::render( array( 'page-' . $timber_post->post_name . '.twig', 'template-musings.twig' ), $context );
