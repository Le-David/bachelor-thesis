<?php
/**
 * Template Name: Articles
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::context();
$excludedCategory = Timber::get_terms([
    'taxonomy' => 'category',
    'slug' => 'uncategorized',
    ]);
$totalPages = get_option('posts_per_page');

$timber_post     = new Timber\Post();
$context['post'] = $timber_post;
$context['categories'] = Timber::get_terms([
    'post_type' =>'post',
    'post_status' =>'publish',
    'taxonomy' => 'category',
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'posts_per_page' => $totalPages,
    'exclude' => $excludedCategory[0]->id,
]);
$context['related_posts'] = Timber::get_posts([
    'post_type' =>'post',
    'post_status' =>'publish',
    'order' => 'DESC',
    'orderby' => 'date',
    'posts_per_page' => $totalPages,
]);
Timber::render( array( 'page-' . $timber_post->post_name . '.twig', 'template-articles.twig' ), $context );
