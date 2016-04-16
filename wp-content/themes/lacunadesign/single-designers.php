<?php get_header(); ?>

<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<div class="container">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_format() );

			the_post_navigation();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		<?php $terms = get_the_terms( $post->ID , 'designers' ); 
                    foreach ( $terms as $term ) {
                        $term_link = get_term_link( $term, 'designers' );
                        if( is_wp_error( $term_link ) )
                        continue;
                    echo '<a href="' . $term_link . '">' . $term->name . '</a>';
                    } 
                ?>
		</div>
		</main><!-- #main -->
	</div><!-- #primary -->

 <?php get_footer(); ?>