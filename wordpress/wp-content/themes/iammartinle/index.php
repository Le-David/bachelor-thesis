<?php
/**
 * The main template file
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
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
$templates        = array( 'template-articles.twig' ,'index.twig' );
if ( is_home() ) {
	array_unshift( $templates, 'front-page.twig', 'home.twig' );
}
Timber::render( $templates, $context );
