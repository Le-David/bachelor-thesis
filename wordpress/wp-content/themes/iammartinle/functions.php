<?php
/**
 * Timber starter-theme
 * https://github.com/timber/starter-theme
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

/**
 * If you are installing Timber as a Composer dependency in your theme, you'll need this block
 * to load your dependencies and initialize Timber. If you are using Timber via the WordPress.org
 * plug-in, you can safely delete this block.
 */
$composer_autoload = __DIR__ . '/vendor/autoload.php';
if ( file_exists( $composer_autoload ) ) {
	require_once $composer_autoload;
	$timber = new Timber\Timber();
}

/**
 * This ensures that Timber is loaded and available as a PHP class.
 * If not, it gives an error message to help direct developers on where to activate
 */
if ( ! class_exists( 'Timber' ) ) {

	add_action(
		'admin_notices',
		function() {
			echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
		}
	);

	add_filter(
		'template_include',
		function( $template ) {
			return get_stylesheet_directory() . '/static/no-timber.html';
		}
	);
	return;
}

/**
 * Sets the directories (inside your theme) to find .twig files
 */
Timber::$dirname = array( 'templates', 'views' );

/**
 * By default, Timber does NOT autoescape values. Want to enable Twig's autoescape?
 * No prob! Just set this value to true
 */
Timber::$autoescape = false;


/**
 * We're going to configure our theme inside of a subclass of Timber\Site
 * You can move this to its own file and include here via php's include("MySite.php")
 */
class StarterSite extends Timber\Site {
	/** Add timber support. */
	public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'theme_supports' ) );
		add_filter( 'timber/context', array( $this, 'add_to_context' ) );
		add_filter( 'timber/twig', array( $this, 'add_to_twig' ) );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
		parent::__construct();
	}
	/** This is where you can register custom post types. */
	public function register_post_types() {

		// Function to change "posts" to "Articles" in the admin side menu
		function change_post_menu_label() {
			global $menu;
			global $submenu;
			$menu[5][0] = 'Articles';
			$submenu['edit.php'][5][0] = 'Articles';
			$submenu['edit.php'][10][0] = 'Add Article';
			$submenu['edit.php'][16][0] = 'Tags';
		}
		// Function to change post object labels to "Articles"
		function change_post_object_label() {
			global $wp_post_types;
			$labels = &$wp_post_types['post']->labels;
			$labels->name = 'Articles';
			$labels->singular_name = 'Article';
			$labels->add_new = 'Add Article';
			$labels->add_new_item = 'Add Article';
			$labels->edit_item = 'Edit Article';
			$labels->new_item = 'Article';
			$labels->view_item = 'View Article';
			$labels->search_items = 'Search Articles';
			$labels->not_found = 'No Articles found';
			$labels->not_found_in_trash = 'No Articles found in Trash';
		}

		/**
		 *  Register Musings post type
		 */
		$musing_labels = array(
			'name'               => _x( 'Musings', 'post type general name' ),
			'singular_name'      => _x( 'Musing', 'post type singular name' ),
			'add_new'            => _x( 'Add musing', 'musing' ),
			'add_new_item'       => __( 'Add New Musing' ),
			'edit_item'          => __( 'Edit Musing' ),
			'new_item'           => __( 'New Musing' ),
			'all_items'          => __( 'All Musings' ),
			'view_item'          => __( 'View Musing' ),
			'search_items'       => __( 'Search Musings' ),
			'not_found'          => __( 'No musings found' ),
			'not_found_in_trash' => __( 'No musings found in the Trash' ), 
			'menu_name'          => 'Musings'
		  );

		$musing_args = array(
			'labels'        => $musing_labels,
			'description'   => 'Posts for musings',
			'public'        => true,
			'menu_position' => 5,
			'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
			'show_in_rest'  => true, // allow gutenberg
			'rewrite'       => array( 'slug' => 'musings', 'with_front' => false )
		);

		register_post_type( 'musings', $musing_args );
		add_action( 'admin_menu', 'change_post_menu_label' );
		add_action( 'init', 'change_post_object_label' );
	}
	/** This is where you can register custom taxonomies. */
	public function register_taxonomies() {

	}

	/** This is where you add some context
	 *
	 * @param string $context context['this'] Being the Twig's {{ this }}.
	 */
	public function add_to_context( $context ) {
		$context['foo']   = 'bar';
		$context['stuff'] = 'I am a value set in your functions.php file';
		$context['notes'] = 'These values are available everytime you call Timber::context();';
		$context['menu']  = new Timber\Menu();
		$context['navigation']  = new Timber\Menu('primary-navigation');
		$context['social_channels']  = new Timber\Menu('social-channels');
		$context['static']  = get_template_directory_uri() . '/static';
		$context['site']  = $this;
		return $context;
	}

	public function theme_supports() {
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support(
			'post-formats',
			array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
				'gallery',
				'audio',
			)
		);

		add_theme_support( 'menus' );
	}

	/**
	 * Own Functions
	 */

	 /** This Would return 'foo bar!'.
	 *
	 * @param string $text being 'foo', then returned 'foo bar!'.
	 */
	public function myfoo( $text ) {
		$text .= ' bar!';
		return $text;
	}

	public function getMusings(){

		$totalPages = get_option('posts_per_page');

		$query = new WP_Query([
			'post_type' =>'musings',
			'post_status' =>'publish',
			'order' => 'DESC',
			'orderby' => 'date',
			'posts_per_page' => $totalPages,
		]);

		return $query;
	}

	/** This is where you can add your own functions to twig.
	 *
	 * @param string $twig get extension.
	 */
	public function add_to_twig( $twig ) {
		$twig->addExtension( new Twig\Extension\StringLoaderExtension() );
		$twig->addFilter( new Twig\TwigFilter( 'myfoo', array( $this, 'myfoo' ) ) );
		$twig->addFunction( new Twig\TwigFunction( 'getMusings', array( $this, 'getMusings' ) ) );
		return $twig;
	}

}

new StarterSite();

/**
 * Custom gutenberg blocks
 */

require get_template_directory() . '/src/gutenberg_blocks/asideMediaContent.php';
