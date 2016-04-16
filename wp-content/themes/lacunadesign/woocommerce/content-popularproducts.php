<div class="row products">
<?php 
// the query
$popularproduct = new WP_Query( array( 'page_id' => 127 ) ); ?>

<?php if ( $popularproduct->have_posts() ) : ?>

	<!-- pagination here -->

	<!-- the loop -->
	<?php while ( $popularproduct->have_posts() ) : $popularproduct->the_post(); ?>
		<div class="col-sm-12">
			<h2><?php the_title(); ?></h2>
			<?php the_content(); ?>
		</div>
	<?php endwhile; ?>
	<!-- end of the loop -->

	<!-- pagination here -->

	<?php wp_reset_postdata(); ?>

<?php else : ?>
	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>
</div>