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
        $classes[] = 'col-md-3 col-sm-4';
 
        return $classes;
 
    } // End woo_custom_add_post_classes()

// Register Custom Navigation Walker
require_once('wp_bootstrap_navwalker.php');
