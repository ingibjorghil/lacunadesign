<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Lacuna_Design
 */

?>

	<footer id="footer" class="footer-wrap" role="contentinfo">
		<div class="site-footer">
		<div class="container">
			<p>&copy; Copyright <?php echo date('Y'); ?> - <?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?></p>
			<span class="sep"> | </span>
			<a href="mailto:info@lacunadesign.dk" target="_bland">info@lacunadesign.dk</a>
			</div>
		</div>
	</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>
