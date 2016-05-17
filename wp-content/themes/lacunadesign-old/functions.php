<?php
/**
 * Lacuna Design functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Lacuna_Design
 */

if ( ! function_exists( 'lacunadesign_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function lacunadesign_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Lacuna Design, use a find and replace
	 * to change 'lacunadesign' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'lacunadesign', get_template_directory() . '/languages' );

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

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'lacunadesign' ),
		'mobile-nav' => esc_html__('Mobile Nav', 'lacunadesign' ),
		'top-nav' => esc_html__('Top Nav', 'lacunadesign' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'lacunadesign_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'lacunadesign_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function lacunadesign_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'lacunadesign_content_width', 640 );
}
add_action( 'after_setup_theme', 'lacunadesign_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function lacunadesign_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'lacunadesign' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Search', 'lacunadesign' ),
		'id'            => 'search-form',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'lacunadesign_widgets_init' );


/**
 * Enqueue scripts and styles.
 */
function lacunadesign_scripts() {
	
	wp_enqueue_style( 'bootstrap', get_stylesheet_directory_uri() . '/sass/bootstrap.css', array(), '3.3.6', 'all' );
	wp_enqueue_style( 'font-awesome', get_stylesheet_directory_uri() . '/fonts/font-awesome/css/font-awesome.min.css', '4.5.0', 'all' );
	wp_enqueue_style( 'lacunadesign-style', get_stylesheet_uri() );
	
	wp_enqueue_script( 'lacunadesign-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
	
	wp_enqueue_script( 'custom-js', get_template_directory_uri() . '/js/custom.js', array(), '1.0.0' );
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.js', array(), '3.3.6' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'lacunadesign_scripts' );

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

function my_theme_wrapper_start() {
  echo '<section id="main">';
}

function my_theme_wrapper_end() {
  echo '</section>';
}

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}


add_filter( 'post_class', 'woo_custom_add_post_classes', 10 );
 
    function woo_custom_add_post_classes ( $classes ) {
        if ( is_singular() ) { return $classes; }
 
        global $wp_query;
 
        // Get the number of the current post in the loop.
        $current_count = $wp_query->current_post + 1;
 
        // Work out whether this post is odd or even in the list.
        $oddeven = 'odd';
        if ( $current_count % 2 == 0 ) { $oddeven = 'even'; } else { $oddeven = 'odd'; }
 
        // Add the classes to the array of CSS classes.
        $classes[] = 'col-md-3 col-sm-4';
 
        return $classes;
 
    } // End woo_custom_add_post_classes()


/**
         * Create custom taxonomy for products
         */    
        function designer_taxonomy() {
            $labels = array(
                'name'              => _x( 'Designer', 'woocommerce' ),
                'singular_name'     => _x( 'Designer', 'woocommerce' ),
                'search_items'      => __( 'Search Designer', 'woocommerce' ),
                'all_items'         => __( 'All Designer', 'woocommerce' ),
                'parent_item'       => __( 'Parent Designer', 'woocommerce' ),
                'parent_item_colon' => __( 'Parent Designer:', 'woocommerce' ),
                'edit_item'         => __( 'Edit Designer', 'woocommerce' ), 
                'update_item'       => __( 'Update Designer', 'woocommerce' ),
                'add_new_item'      => __( 'Add New Designer', 'woocommerce' ),
                'new_item_name'     => __( 'New Designer', 'woocommerce' ),
                'menu_name'         => __( 'Designers', 'woocommerce' ),
                'search_items'      => __( 'Search Designer', 'woocommerce' ),
            );
        
        $args = array(
            'labels' => $labels,
            'hierarchical' => true,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => true,
            'show_admin_column' => true,
            'capabilities'          => array(
					'manage_terms' => 'manage_product_terms',
					'edit_terms'   => 'edit_product_terms',
					'delete_terms' => 'delete_product_terms',
					'assign_terms' => 'assign_product_terms',
				),
        );
        register_taxonomy( 'designer', 'product', $args );        
    }
    add_action( 'init', 'designer_taxonomy', 0 );


function wpse53892_taxonomy_template_redirect() {

    // Only modify custom taxonomy template redirect
    if ( is_tax('designer') ) {
        // Get the queried term
        $term = get_queried_object();

        // Determine if term has a parent;
        // I *think* this will work; if not see above
        if ( 0 != $term->parent ) {
            // Tell WordPress to use the parent template
            $parent = get_term( $term->parent );
            // Load parent taxonomy template
            get_query_template( 'woocommerce', 'taxonomy-' . $term->taxonomy . '-' . $parent->slug . 'php' );
        }
    }
}
add_action( 'template_redirect', 'wpse53892_taxonomy_template_redirect' );

add_filter( 'woocommerce_product_add_to_cart_text' , 'custom_woocommerce_product_add_to_cart_text' );
/**
 * custom_woocommerce_template_loop_add_to_cart
*/
function custom_woocommerce_product_add_to_cart_text() {
	global $product;
	
	$product_type = $product->product_type;
	
	switch ( $product_type ) {
		case 'external':
			return __( 'Buy product', 'woocommerce' );
		break;
		case 'grouped':
			return __( 'View products', 'woocommerce' );
		break;
		case 'simple':
			return __( 'Sæt i kurv', 'woocommerce' );
		break;
		case 'variable':
			return __( 'Select options', 'woocommerce' );
		break;
		default:
			return __( 'Read more', 'woocommerce' );
	}
	
}

function remove_loop_button(){
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
}
add_action('init','remove_loop_button');



/*STEP 2 -ADD NEW BUTTON THAT LINKS TO PRODUCT PAGE FOR EACH PRODUCT */

add_action('woocommerce_after_shop_loop_item','replace_add_to_cart');
function replace_add_to_cart() {
global $product;
$link = $product->get_permalink();
echo do_shortcode('<div class="button-wrap"><a href="'.$link.'" class="button view-product">Se mere</a></div>');
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


//Register Custom Navigation Walker
require_once('wp_bootstrap_navwalker.php');