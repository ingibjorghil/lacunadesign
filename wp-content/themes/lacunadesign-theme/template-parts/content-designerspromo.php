<?php 
	$name = array( 
			'designer-brand', 
			'fab-design',
			'blethbla'
		);
	$id = array(
		'16',
		'17',
		'18'
		);

	$rand_designer = array_rand($name, 1);
	$rand_designer = array_rand($id, 1);


	//echo $name[$rand_designer];
?>
<div class="row">
	<h1>En af vores designere</h1>
</div>
<div class="row">
	<div class="col-sm-3">
		<h2><a href="http://localhost:8888/produkt-kategori/<?php echo $name[$rand_designer] ?>"><?php echo $name[$rand_designer] ?></a></h2>
		<p><?php the_field( $name[$rand_designer], 178 ); ?></p>
	</div>
	<div class="col-sm-9">
		<?php echo do_shortcode('[product_category category="'.$name[$rand_designer].'" per_page="4"]' ); ?>
	</div>
</div>








