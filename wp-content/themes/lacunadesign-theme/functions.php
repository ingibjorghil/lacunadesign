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
 
    wp_enqueue_script( 'lacunadesign-skip-link-focus-fix', get_stylesheet_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
    
    wp_enqueue_script( 'bootstrap-js', get_stylesheet_directory_uri() . '/js/bootstrap.js', array(), '3.3.6', true );
    wp_enqueue_script( 'lacunadesign-custom-js', get_stylesheet_directory_uri() . '/js/custom.js', array(), '1.0.0', true );

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
    Replace product sharing
*/


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
    <div class="header-container">
        <div id="header-logo-search" class="container">  
            <div class="row">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo-link" rel="home">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/lacuna_logo.svg" alt="<?php echo get_bloginfo( 'name' ); ?>" />
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
                <div class="header-logo">
                   <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header-logo-link" rel="home">
                        <img class="lacuna-top-logo" src="<?php echo get_stylesheet_directory_uri(); ?>/img/lacuna_logo.svg" alt="<?php echo get_bloginfo( 'name' ); ?>" />
                    </a>
                </div>
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


/**
 * Change the number of related products in the single product page.
 *
 * @param  array $args
 * @return array
 */
function wc_custom_related_products_number( $args ) {
    if ( isset( $args['posts_per_page'] ) ) {
        $args['posts_per_page'] = 4;
    }

    return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'wc_custom_related_products_number' );

add_filter( 'woocommerce_output_related_products_args', 'wc_custom_related_products_number', 11 );

/**
 * Changes the redirect URL for the Return To Shop button in the cart.
 *
 * @return string
 */
function wc_empty_cart_redirect_url() {
    return  site_url(); ;
}
add_filter( 'woocommerce_return_to_shop_redirect', 'wc_empty_cart_redirect_url' );

add_action( 'init', 'custom_remove_footer_credit', 10 );

function custom_remove_footer_credit () {
    remove_action( 'storefront_footer', 'storefront_credit', 20 );
    add_action( 'storefront_footer', 'custom_storefront_credit', 20 );
} 

function custom_storefront_credit() {
    ?>
    <div class="site-info">
        &copy; <?php echo get_bloginfo( 'name' ) . ' IVS - ' . get_the_date( 'Y' ); ?>
    </div><!-- .site-info -->
    <?php
}

if ( ! function_exists( 'storefront_cart_link' ) ) {

    function storefront_cart_link() {
        ?>
            <a class="cart-contents" href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'storefront' ); ?>">
                <span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo wp_kses_data( sprintf( _n( '%d', WC()->cart->get_cart_contents_count(), 'storefront' ), WC()->cart->get_cart_contents_count() ) );?></span>
            </a>
        <?php
    }
}

// Post functions

if ( ! function_exists( 'lacuna_post_header' ) ) {
    function lacuna_post_header() {
        ?>
        <header class="entry-header">
        <?php
        if ( is_single() ) {
            the_title( '<h1 class="entry-title" itemprop="name headline">', '</h1>' );
            storefront_posted_on();
        } else {
            
            the_title( sprintf( '<h1 class="entry-title" itemprop="name headline"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' );
            if ( 'post' == get_post_type() ) {
                storefront_posted_on();
            }
        }
        ?>
        <?php
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list( __( ', ', 'storefront' ) );

            if ( $categories_list ) : ?>
                <div class="cat-links">
                    <?php
                    echo '<div class="label">' . esc_attr( __( 'Posted in', 'storefront' ) ) . '</div>';
                    echo wp_kses_post( $categories_list );
                    ?>
                </div>
            <?php endif; // End if categories. ?>
        </header><!-- .entry-header -->
        <?php
    }
}


if ( ! function_exists( 'lacuna_post_content' ) ) {

    function lacuna_post_content() {
        ?>
        <div class="entry-content" itemprop="articleBody">
        <?php
        storefront_post_thumbnail( 'full' );

        the_content(
            sprintf(
                __( 'Continue reading %s', 'storefront' ),
                '<span class="screen-reader-text">' . get_the_title() . '</span>'
            )
        );

        wp_link_pages( array(
            'before' => '<div class="page-links">' . __( 'Pages:', 'storefront' ),
            'after'  => '</div>',
        ) );
        ?>
        </div><!-- .entry-content -->
        <?php
    }
}

if ( ! function_exists( 'lacuna_post_meta' ) ) {
    /**
     * Display the post meta
     *
     * @since 1.0.0
     */
    function lacuna_post_meta() {
        ?>
        <aside class="entry-meta">
            <?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search.

            ?>
            <div class="author">
                <?php
                    echo get_avatar( get_the_author_meta( 'ID' ), 128 );
                    echo '<div class="label">' . esc_attr( __( 'Written by', 'storefront' ) ) . '</div>';
                    the_author_posts_link();
                ?>
            </div>
            <?php
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list( __( ', ', 'storefront' ) );

            if ( $categories_list ) : ?>
                <div class="cat-links">
                    <?php
                    echo '<div class="label">' . esc_attr( __( 'Posted in', 'storefront' ) ) . '</div>';
                    echo wp_kses_post( $categories_list );
                    ?>
                </div>
            <?php endif; // End if categories. ?>

            <?php
            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list( '', __( ', ', 'storefront' ) );

            if ( $tags_list ) : ?>
                <div class="tags-links">
                    <?php
                    echo '<div class="label">' . esc_attr( __( 'Tagged', 'storefront' ) ) . '</div>';
                    echo wp_kses_post( $tags_list );
                    ?>
                </div>
            <?php endif; // End if $tags_list. ?>

        <?php endif; // End if 'post' == get_post_type(). ?>

            <?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
                <div class="comments-link">
                    <?php echo '<div class="label">' . esc_attr( __( 'Comments', 'storefront' ) ) . '</div>'; ?>
                    <span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'storefront' ), __( '1 Comment', 'storefront' ), __( '% Comments', 'storefront' ) ); ?></span>
                </div>
            <?php endif; ?>
        </aside>
        <?php
    }
}


if ( ! function_exists( 'lacuna_post_nav' ) ) {
    /**
     * Display navigation to next/previous post when applicable.
     */
    function lacuna_post_nav() {
        $args = array(
            'next_text' => '%title',
            'prev_text' => '%title',
            );
        the_post_navigation( $args );
    }
}

if ( ! function_exists( 'lacuna_posted_on' ) ) {
    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function lacuna_posted_on() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s" itemprop="datePublished">%2$s</time>';
        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time> <time class="updated" datetime="%3$s" itemprop="datePublished">%4$s</time>';
        }

        $time_string = sprintf( $time_string,
            esc_attr( get_the_date( 'c' ) ),
            esc_html( get_the_date() ),
            esc_attr( get_the_modified_date( 'c' ) ),
            esc_html( get_the_modified_date() )
        );

        $posted_on = sprintf(
            _x( 'Posted on %s', 'post date', 'storefront' ),
            '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
        );

        echo wp_kses( apply_filters( 'storefront_single_post_posted_on_html', '<span class="posted-on">' . $posted_on . '</span>', $posted_on ), array(
            'span' => array(
                'class'  => array(),
            ),
            'a'    => array(
                'href'  => array(),
                'title' => array(),
                'rel'   => array(),
            ),
            'time' => array(
                'datetime' => array(),
                'itemprop' => array(),
                'class'    => array(),
            ),
        ) );
    }
}

if ( ! function_exists( 'lacuna_post_thumbnail' ) ) {
    /**
     * Display post thumbnail
     *
     * @var $size thumbnail size. thumbnail|medium|large|full|$custom
     * @uses has_post_thumbnail()
     * @uses the_post_thumbnail
     * @param string $size the post thumbnail size.
     * @since 1.5.0
     */
    function lacuna_post_thumbnail( $size ) {
        if ( has_post_thumbnail() ) {
            the_post_thumbnail( $size, array( 'itemprop' => 'image' ) );
        }
    }
}

/**
 * Posts
 *
 */
remove_action( 'storefront_loop_post',         'storefront_post_header',      10 );
remove_action( 'storefront_loop_post',         'storefront_post_meta',        20 );
remove_action( 'storefront_loop_post',         'storefront_post_content',     30 );
remove_action( 'storefront_loop_after',        'storefront_paging_nav',       10 );
remove_action( 'storefront_single_post',       'storefront_post_header',      10 );
remove_action( 'storefront_single_post',       'storefront_post_meta',        20 );
remove_action( 'storefront_single_post',       'storefront_post_content',     30 );
remove_action( 'storefront_single_post_after', 'storefront_post_nav',         10 );
remove_action( 'storefront_single_post_after', 'storefront_display_comments', 20 );


/**
 * Posts rearrange
 *
 */
add_action( 'lacuna_loop_post',         'lacuna_post_header',      10 );
add_action( 'lacuna_loop_post',         'lacuna_post_content',     30 );
add_action( 'lacuna_loop_after',        'lacuna_paging_nav',       10 );
add_action( 'lacuna_single_post',       'lacuna_post_header',      10 );
add_action( 'lacuna_single_post',       'lacuna_post_content',     20 );
add_action( 'lacuna_single_post_after', 'lacuna_post_nav',         10 );
add_action( 'lacuna_single_post_after', 'storefront_display_comments', 20 );

add_filter( 'the_content_more_link', 'modify_read_more_link' );
function modify_read_more_link() {
return '<br><a class="more-link" href="' . get_permalink() . '">Læs mere</a>';
}

