<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package storefront
 */

get_header(); ?>
<div class="container">
	<div id="primary" class="content-area">

		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">

				<div class="page-content">
					
					<header class="page-header">
						<h1 class="page-title"><?php esc_html_e( 'Oops! Den side findes ikke.', 'storefront' ); ?></h1>
					</header><!-- .page-header -->
					<div class="row">
						<div class="col-sm-8">
							<p><?php esc_html_e( 'Intet blev fundet på dette sted. Prøv at søge, eller tjek nedenstående links.', 'storefront' ); ?></p>

							<?php
							if ( is_woocommerce_activated() ) {
								the_widget( 'WC_Widget_Product_Search' );
							} else {
								get_search_form();
							}
							?>
						</div>
						<?php
						if ( is_woocommerce_activated() ) {
							echo '<div class="col-sm-4">';

								echo '<h2>' . esc_html__( 'Product Categories', 'storefront' ) . '</h2>';

								the_widget( 'WC_Widget_Product_Categories', array(
															'count'		=> 1,
														) );
							echo '</div>';

						echo '</div>';

						echo '<h2>' . esc_html__( 'Popular Products', 'storefront' ) . '</h2>';

						echo storefront_do_shortcode( 'best_selling_products', array(
															'per_page' 	=> 4,
															'columns'	=> 4,
														) );
						
							
						echo '<div class="row">';

							echo '<div class="col-sm-12">';

								storefront_promoted_products( $per_page = '4');

							echo '</div>';

							
					}
					?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->
</div>
<?php get_footer(); ?>
