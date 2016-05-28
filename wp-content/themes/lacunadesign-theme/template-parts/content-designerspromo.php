<?php 
	$name = array( 
			'fab-design', 
			'vinyl-pro',
			'xxxposters'
		);
	$id = array(
		'16',
		'17',
		'18'
		);
	$title = array(
		'Fab Design',
		'Vinyl Pro',
		'XXX Posters'
		);

	$rand_designer = array_rand($name, 1);
	$rand_designer = array_rand($id, 1);
	$rand_designer = array_rand($title, 1);


	//echo $name[$rand_designer];
?>
<div class="row headline">
	<div class="col-sm-12">
		<h1><?php the_field('designer_promo_title', 178) ?></h1>
		<p><?php the_field('designer_promo_text', 178) ?></p>
	</div>
</div>
<div class="row">
	<div class="col-sm-3">
		<h2><a href="http://localhost:8888/produkt-kategori/<?php echo $name[$rand_designer] ?>"><?php echo $title[$rand_designer] ?></a></h2>
		<p><?php the_field( $name[$rand_designer], 178 ); ?></p>
	</div>
	<div class="col-sm-9">
		<?php echo do_shortcode('[product_category category="'.$name[$rand_designer].'" per_page="4"]' ); ?>
	</div>
</div>








