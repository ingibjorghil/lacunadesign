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

	</div>

	<footer id="colophon" class="site-footer" role="contentinfo">
			<p>&copy; Copyright <?php echo date('Y'); ?> - <?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?></p>
			<span class="sep"> | </span>
			<a href="mailto:info@lacunadesign.dk" target="_bland">info@lacunadesign.dk</a>
	</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>
