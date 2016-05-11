<?php

/**
 * Storefront automatically loads the core CSS even if using a child theme as it is more efficient
 * than @importing it in the child theme style.css file.
 *
 * Uncomment the line below if you'd like to disable the Storefront Core CSS.
 *
 * If you don't plan to dequeue the Storefront Core CSS you can remove the subsequent line and as well
 * as the sf_child_theme_dequeue_style() function declaration.
 */
//add_action( 'wp_enqueue_scripts', 'sf_child_theme_dequeue_style', 999 );

/**
 * Dequeue the Storefront Parent theme core CSS
 */
function sf_child_theme_dequeue_style() {
    wp_dequeue_style( 'storefront-style' );
    wp_dequeue_style( 'storefront-woocommerce-style' );
}

function lacunadesign_scripts() {
    
    wp_enqueue_style( 'bootstrap', get_stylesheet_directory_uri() . '/sass/bootstrap.css', array(), '3.3.6', 'all' );
    wp_enqueue_style( 'font-awesome', get_stylesheet_directory_uri() . '/fonts/font-awesome/css/font-awesome.min.css', '4.5.0', 'all' );
    wp_enqueue_style( 'lacunadesign-style', get_stylesheet_uri() );
    
    wp_enqueue_script( 'lacunadesign-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
    
    wp_enqueue_script( 'bootstrap-js', get_stylesheet_directory_uri() . '/js/bootstrap.js', array(), '3.3.6', true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'lacunadesign_scripts' );

/**
 * Note: DO NOT! alter or remove the code above this text and only add your custom PHP functions below this text.
 */

function designerlogo_post_type() {
   
   // Labels
    $labels = array(
        'name' => _x("Designer logo", "post type general name"),
        'singular_name' => _x("Designer logo", "post type singular name"),
        'menu_name' => 'Designer logo',
        'add_new' => _x("Add New", "Designer logo"),
        'add_new_item' => __("Add New Designer logo"),
        'edit_item' => __("Edit Designer logo"),
        'new_item' => __("New Designer logo"),
        'view_item' => __("View Designer logo"),
        'search_items' => __("Search Designer logo"),
        'not_found' =>  __("No Designer logo Found"),
        'not_found_in_trash' => __("No Designer logo Found in Trash"),
        'parent_item_colon' => ''
    );
    
    // Register post type
    register_post_type('designerlogo' , array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-id',
        'rewrite' => false,
        'supports' => array('title', 'thumbnail')
    ) );
}

add_action( 'init', 'designerlogo_post_type', 0 );

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
        $classes[] = 'col-md-4 col-sm-6';
 
        return $classes;
 
    } // End woo_custom_add_post_classes()

// Register Custom Navigation Walker
require_once('wp_bootstrap_navwalker.php');

if ( ! function_exists( 'storefront_before_content' ) ) {
    function storefront_before_content() {
        ?>
        <div id="primary" class="content-primary container">
            <main id="main" class="site-main" role="main">
            <?php
    }
}
/**
 * Sorting wrapper
 * @since   1.4.3
 * @return  void
 */
function lacuna_sorting_wrapper() {
    echo '<div class="product-sorting">';
}

/**
 * Sorting wrapper close
 * @since   1.4.3
 * @return  void
 */
function lacuna_sorting_wrapper_close() {
    echo '</div>';
}

remove_action( 'woocommerce_before_shop_loop',         'storefront_sorting_wrapper',               9 );
remove_action( 'woocommerce_before_shop_loop',         'woocommerce_catalog_ordering',             10 );
remove_action( 'woocommerce_before_shop_loop',         'woocommerce_result_count',                 20 );
remove_action( 'woocommerce_before_shop_loop',         'storefront_woocommerce_pagination',        30 );
remove_action( 'woocommerce_before_shop_loop',         'storefront_sorting_wrapper_close',         31 );

add_action( 'woocommerce_before_shop_loop',         'lacuna_sorting_wrapper',               9 );
add_action( 'woocommerce_before_shop_loop',         'woocommerce_result_count',                 20 );
add_action( 'woocommerce_before_shop_loop',         'woocommerce_catalog_ordering',             10 );
add_action( 'woocommerce_before_shop_loop',         'storefront_woocommerce_pagination',        30 );
add_action( 'woocommerce_before_shop_loop',         'lacuna_sorting_wrapper_close',         31 );

// Remove the product rating display on product loops
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );


/**
 * Related Products Args
 * @param  array $args related products args
 * @since 1.0.0
 * @return  array $args related products args
 */
function storefront_related_products_args( $args ) {
    $args = apply_filters( 'storefront_related_products_args', array(
        'posts_per_page' => 4,
        'columns'        => 4,
    ) );

    return $args;
}

add_action( 'get_header', 'remove_storefront_sidebar' );

function remove_storefront_sidebar() {
    if ( is_product() ) {
        remove_action( 'storefront_sidebar', 'storefront_get_sidebar',          10 );
    }
}


add_action( 'init', 'storefront_custom_logo' );
function storefront_custom_logo() {
    remove_action( 'storefront_header', 'storefront_site_branding', 20 );
    add_action( 'storefront_header', 'storefront_display_custom_logo', 20 );
}

function storefront_display_custom_logo() {
?>
    <div class="row">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo-link" rel="home">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/lacunalogo_noback.svg" alt="<?php echo get_bloginfo( 'name' ); ?>" />
        </a>
<?php
}
add_action( 'init', 'storefront_custom_product_search');
function Storefront_custom_product_search() {
    remove_action( 'storefront_header', 'storefront_product_search', 40);
    add_action( 'storefront_custom_header', 'storefront_display_custom_product_search', 40);
}
    function storefront_display_custom_product_search() {
        if ( is_woocommerce_activated() ) { ?>
            <div class="site-search">
                <?php the_widget( 'WC_Widget_Product_Search', 'title=' ); ?>
            </div>
            </div>
        <?php
        }
    }

add_action( 'init', 'storefront_custom_secondary_navigation' );
function storefront_custom_secondary_navigation(){
    remove_action( 'storefront_header', 'storefront_secondary_navigation',  20  );
    add_action( 'storefront_custom_header', 'storefront_display_custom_secondary_navigation',  20 );
}
function storefront_display_custom_secondary_navigation() {
        ?>
        <div class="header-cart-wrap">
            <div class="container">
                <nav class="secondary-navigation" role="navigation" aria-label="<?php esc_html_e( 'Secondary Navigation', 'storefront' ); ?>">
                    <?php
                        wp_nav_menu(
                            array(
                                'theme_location'    => 'secondary',
                                'fallback_cb'       => '',
                            )
                        );
                    ?>
                </nav><!-- #site-navigation -->
        <?php
    }

add_action( 'init', 'storefront_custom_header_cart' );
function storefront_custom_header_cart() {
    remove_action( 'storefront_header', 'storefront_header_cart',   30  );
    add_action('storefront_custom_header', 'storefront_display_custom_header_cart',  30  );
function storefront_display_custom_header_cart() {
        if ( is_woocommerce_activated() ) {
            if ( is_cart() ) {
                $class = 'current-menu-item';
            } else {
                $class = '';
            }
        ?>
                <ul class="site-header-cart menu">
                    <li class="<?php echo esc_attr( $class ); ?>">
                        <?php storefront_cart_link(); ?>
                    </li>
                    <li>
                        <?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
                    </li>
                </ul>
            </div>
        </div>
        <div class="container">
        <?php
        }
    }
}

remove_action( 'storefront_header', 'storefront_skip_links',            0 );
remove_action( 'storefront_header', 'storefront_secondary_navigation',  20 );
remove_action( 'storefront_header', 'storefront_site_branding',         30 );
remove_action( 'storefront_header', 'storefront_primary_navigation',    50 );

add_action( 'storefront_custom_header', 'storefront_skip_links',                           0 );
add_action( 'storefront_custom_header', 'storefront_display_custom_secondary_navigation',  20 );
add_action( 'storefront_custom_header', 'storefront_display_custom_header_cart',           30 );
add_action( 'storefront_custom_header', 'storefront_display_custom_logo',                  40 );
add_action( 'storefront_custom_header', 'storefront_custom_product_search',                50 );
add_action( 'storefront_custom_header', 'storefront_primary_navigation',                   60 );