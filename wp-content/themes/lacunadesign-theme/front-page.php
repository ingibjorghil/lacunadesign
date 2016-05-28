<?php get_header(); ?>
<div class="site-main">
<?php while ( have_posts() ) : the_post(); ?>	
	<?php do_action( 'storefront_page_before' ); ?>
<section id="front-images">
	<?php get_template_part( 'template-parts/content', 'frontimages' ); ?>
</section>
<section id="designer-promo">
	<div class="wrapper-content">
		<div class="container">
			<?php get_template_part( 'template-parts/content', 'designerspromo' ); ?>
		</div>
	</div>
</section>
<section id="popular-item">
	<div class="wrapper-skew">
		<div class="wrapper-content">
			<div class="container">
				<?php get_template_part( 'template-parts/content', 'popularproducts' ); ?>
			</div>
		</div>
	</div>
</section>
<section id="designer-logo">
	<?php get_template_part( 'template-parts/content', 'designerlogo' ); ?>
</section>
<section id="lacuna-info">
	<div class="container-fluid">
		<?php get_template_part( 'template-parts/content', 'lacuna-info' ); ?>
	</div>
</section>
	<?php endwhile; // end of the loop. ?>
</div>
<?php get_footer(); ?>