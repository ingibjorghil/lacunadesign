<?php get_header('shop'); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div class="container">
		<?php
			while ( have_posts() ) : the_post(); ?>
				<h1><?php the_title(); ?></h1>
				<div class="col-sm-12">
					<?php the_content(); ?>
				</div>
				<div>
				</div>

		<?php
			endwhile; // End of the loop.
		?>

		
		
		</div>
	</main><!-- #main -->
</div><!-- #primary -->

 <?php get_footer('shop'); ?>