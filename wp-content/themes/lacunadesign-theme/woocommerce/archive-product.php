<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header(); ?>


	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>
	<div class="designer-header">
		<div class="row">
			<?php 
				$term_id = get_queried_object()->term_id;
				$post_id = 'product_cat_'.$term_id;
				$designerlogo_field = get_field('designer-logo', $post_id);
				$facebook_field = get_field('designer-facebook', $post_id);
				$twitter_field = get_field('designer-twitter', $post_id);
				$instagram_field = get_field('designer-instagram', $post_id);
			 ?>
			 	<img src="<?php echo $designerlogo_field ?>" alt="<?php woocommerce_page_title(); ?> Logo">
		 </div>
	</div>
	<div class="container">
	
		<div class="row">
			<div class="col-sm-3">
				<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
					<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
				<?php endif; ?>	
				<?php echo term_description( $term_id, $taxonomy ) ?>
				<h3>Social media</h3>
				<?php
					if ($facebook_field)
					{
						echo '<a href="' . $facebook_field . '" target="_blank"><span class="fa fa-facebook-official designer-social"></span></a>';
					}

					?>
				<?php
					if ($instagram_field)
					{
						echo '<a href="' . $instagram_field . '" target="_blank"><span class="fa fa-instagram designer-social"></span></a>';
					}

					?>
				<?php
					if ($twitter_field)
					{
						echo '<a href="' . $twitter_field . '"target="_blank"><span class="fa fa-twitter designer-social"></span></a>';
					}

					?>

			</div>

				<?php if ( have_posts() ) : ?>
			<div class="woocommerce col-sm-9">
				<?php
					/**
					 * woocommerce_before_shop_loop hook.
					 *
					 * @hooked woocommerce_result_count - 20
					 * @hooked woocommerce_catalog_ordering - 30
					 */
					do_action( 'woocommerce_before_shop_loop' );
				?>

				<?php woocommerce_product_loop_start(); ?>

					<?php woocommerce_product_subcategories(); ?>

					<?php while ( have_posts() ) : the_post(); ?>

						<?php wc_get_template_part( 'content', 'product' ); ?>

					<?php endwhile; // end of the loop. ?>

				<?php woocommerce_product_loop_end(); ?>
				<?php
					/**
					 * woocommerce_after_shop_loop hook.
					 *
					 * @hooked woocommerce_pagination - 10
					 */
					do_action( 'woocommerce_after_shop_loop' );
				?>
			</div>
		</div>
			


		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php wc_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>
	</div>

<?php get_footer( 'shop' ); ?>
