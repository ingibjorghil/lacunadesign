<?php 
	global $post;
		$args = array(
		'post_type'=>'product',
		'showposts'=>'1',
		'orderby'=>'rand',
		'tax_query'=> array( array(
			'taxonomy' => 'designer',
			'field' => 'slug',
			), ),
		);
$my_query = new WP_Query($args);

		while ($my_query->have_posts()) : $my_query->the_post();

		the_title();

		endwhile;

?>