	<div class="container">
		<h1><?php the_field('designer_logo_title', 178) ?></h1>
		<?php
			// Get 'designerlogo' posts
			$designerlogo_posts = get_posts( array(
				'post_type' => 'designerlogo',
				'posts_per_page' => 6	, 
				'orderby' => 'rand', 
			) );

			if ( $designerlogo_posts ):
		?>
	
		<div class="row">
			<?php 
				foreach ( $designerlogo_posts as $post ): 
				setup_postdata($post);
				
				$thumb_src = null;
				if ( has_post_thumbnail($post->ID) ) {
					$src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'designer-thumb' );
					$thumb_src = $src[0];
			}
			?>	

				<div class="kunder-img col-sm-2">
					<?php if ( $thumb_src ): ?>
					<img src="<?php echo $thumb_src; ?>" alt="<?php the_title(); ?>">
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
