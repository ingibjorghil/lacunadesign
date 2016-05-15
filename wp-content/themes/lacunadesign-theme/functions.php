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


// Register Custom Navigation Walker
require_once('wp_bootstrap_navwalker.php');

if ( ! function_exists( 'storefront_before_content' ) ) {
    function storefront_before_content() {
        ?>
        <div id="primary" class="content-primary">
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
    echo '<div class="product-sorting col-sm-12">';
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

add_action( 'woocommerce_after_shop_loop',        'lacuna_sorting_wrapper',             9 );
add_action( 'woocommerce_after_shop_loop',        'woocommerce_catalog_ordering',           10 );
add_action( 'woocommerce_after_shop_loop',        'woocommerce_result_count',               20 );
add_action( 'woocommerce_after_shop_loop',        'woocommerce_pagination',                 30 );
add_action( 'woocommerce_after_shop_loop',        'lacuna_sorting_wrapper_close',       31 );

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
    <div id="header-logo-search" class="container">
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

/**
     * List all (or limited) product categories.
     *
     * @param array $atts
     * @return string
     */
    function rand_product_categories( $atts ) {
        global $woocommerce_loop;

        $atts = shortcode_atts( array(
            'number'     => null,
            'orderby'    => 'rand',
            'order'      => 'rand',
            'columns'    => '4',
            'hide_empty' => 1,
            'parent'     => '',
            'ids'        => ''
        ), $atts );

        if ( isset( $atts['ids'] ) ) {
            $ids = explode( ',', $atts['ids'] );
            $ids = array_map( 'trim', $ids );
        } else {
            $ids = array();
        }

        $hide_empty = ( $atts['hide_empty'] == true || $atts['hide_empty'] == 1 ) ? 1 : 0;

        // get terms and workaround WP bug with parents/pad counts
        $args = array(
            'orderby'    => $atts['orderby'],
            'order'      => $atts['order'],
            'hide_empty' => $hide_empty,
            'include'    => $ids,
            'pad_counts' => true,
            'child_of'   => $atts['parent']
        );

        $rand_product_categories = get_terms( 'product_cat', $args );

        if ( '' !== $atts['parent'] ) {
            $rand_product_categories = wp_list_filter( $rand_product_categories, array( 'parent' => $atts['parent'] ) );
        }

        if ( $hide_empty ) {
            foreach ( $rand_product_categories as $key => $category ) {
                if ( $category->count == 0 ) {
                    unset( $rand_product_categories[ $key ] );
                }
            }
        }

        if ( $atts['number'] ) {
            $rand_product_categories = array_slice( $rand_product_categories, 0, $atts['number'] );
        }

        $columns = absint( $atts['columns'] );
        $woocommerce_loop['columns'] = $columns;

        ob_start();

        // Reset loop/columns globals when starting a new loop
        $woocommerce_loop['loop'] = $woocommerce_loop['column'] = '';

        if ( shuffle($rand_product_categories) ) {
            woocommerce_product_loop_start();

            foreach ( $rand_product_categories as $category ) {
                wc_get_template( 'content-product_promo.php', array(
                    'category' => $category
                ) );
            }

            woocommerce_product_loop_end();
        }

        woocommerce_reset_loop();

        return '<div class="woocommerce columns-' . $columns . '">' . ob_get_clean() . '</div>';
    }
    add_shortcode( 'rand_prod_cat', 'rand_product_categories' );
    ?>