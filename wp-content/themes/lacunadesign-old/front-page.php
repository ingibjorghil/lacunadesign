<?php get_header(); ?>
<section id="front-images">
	<?php get_template_part( 'template-parts/content', 'frontimages' ); ?>
</section>
<section id="popular-item">
	<div class="wrapper-skew">
		<div class="wrapper-content">
			<div class="container">
				<?php get_template_part( 'woocommerce/content', 'popularproducts' ); ?>
			</div>
		</div>
	</div>
</section>
<section>
	<div class="wrapper-content">
			<div class="container">
				<?php get_template_part( 'woocommerce/content', 'popularproducts' ); ?>
			</div>
		</div>
</section>
<?php get_footer(); ?>