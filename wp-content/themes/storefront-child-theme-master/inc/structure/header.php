<?php
/**
 * Template functions used for the site header.
 *
 * @package storefront
 */

if ( ! function_exists( 'storefront_header_widget_region' ) ) {
	/**
	 * Display header widget region
	 * @since  1.0.0
	 */
	function storefront_header_widget_region() {
		if ( is_active_sidebar( 'header-1' ) ) {
		?>
		<div class="header-widget-region" role="complementary">
			<div class="col-full">
				<?php dynamic_sidebar( 'header-1' ); ?>
			</div>
		</div>
		<?php
		}
	}
}

if ( ! function_exists( 'storefront_site_branding' ) ) {
	/**
	 * Display Site Branding
	 * @since  1.0.0
	 * @return void
	 */
	function storefront_site_branding() {
		if ( function_exists( 'jetpack_has_site_logo' ) && jetpack_has_site_logo() ) {
			jetpack_the_site_logo();
		} else { ?>
			<div class="site-branding">
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php if ( '' != get_bloginfo( 'description' ) ) { ?>
					<p class="site-description"><?php echo bloginfo( 'description' ); ?></p>
				<?php } ?>
			</div>
		<?php }
	}
}

if ( ! function_exists( 'storefront_primary_navigation' ) ) {
	/**
	 * Display Primary Navigation
	 * @since  1.0.0
	 * @return void
	 */
	function storefront_primary_navigation() {
		?>
		<div id="top-nav" class="hidden-xs">
			<nav class="navbar navbar-top navbar-default" role="navigation">
			    <div class="container nav-content">
				    <div id="navbar-top" class="collapse navbar-collapse navbar-ex3-collapse">
				        <?php
				        wp_nav_menu( array(
				        	'menu' => 'secondary',
				            'theme_location' => 'secondary',
				            'depth' => 2,
				            'container' => true,
				            'menu_class' => 'nav navbar-nav navbar-right',
				            'fallback_cb' => 'wp_page_menu',
				            'walker' => new wp_bootstrap_navwalker())
				        );
				        ?>
				    </div>
				</div>
			</nav>
		</div>
		<div class="hidden-xs site-branding container">
			<div class="row">
				<div class="col-sm-6">
					<?php
					if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title"><a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'><img src='<?php echo esc_url( get_theme_mod( 'themeslug_logo' ) ); ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'></a></h1>
					<?php else : ?>
						<h1 class="site-title"><a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'><img src='<?php echo esc_url( get_theme_mod( 'themeslug_logo' ) ); ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'></a></h1>
					<?php
					endif;

					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
					<?php
					endif; ?>
				</div>
				<div class="col-sm-6">
					<?php dynamic_sidebar( 'search-form' ); ?>
				</div>
			</div>
		</div>
		<div id="primary-nav" class="hidden-xs">
			<nav class="navbar navbar-top navbar-default" role="navigation">
			    <div class="container nav-content">
				    <div id="navbar-primary" class="navbar-collapse navbar-ex1-collapse">
				        <?php
				        wp_nav_menu( array(
				        	'menu' => 'primary',
				            'theme_location' => 'primary',
				            'depth' => 2,
				            'container' => true,
				            'menu_class' => 'nav navbar-nav',
				            'fallback_cb' => 'wp_page_menu',
				            'walker' => new wp_bootstrap_navwalker())
				        );
				        ?>
				    </div>
				</div>
			</nav>
		</div>
		<div id="mobile-nav" class="visible-xs">
			<nav class="visible-xs navbar navbar-fixed-top navbar-default" role="navigation">
			    <div class="container nav-content">
			    	<div class="navbar-header">
			    		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
			            	<span class="sr-only">Toggle navigation</span>
			            	<span class="icon-bar"></span>
			            	<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
			    		<?php if ( get_theme_mod( 'themeslug_logo' ) ) : ?>
				        <div class='site-logo'>
				        	<a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'><img src='<?php echo esc_url( get_theme_mod( 'themeslug_logo' ) ); ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'></a>
				        </div>
			        	<?php else : ?>
			          	<hgroup>
			            	<h1 class='site-title'><a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'><?php bloginfo( 'name' ); ?></a></h1>
			     		</hgroup>
			          	<?php endif; ?>
			    	</div>
				    <div id="navbar-collapse" class="collapse navbar-collapse navbar-ex2-collapse">
				        <?php
				        wp_nav_menu( array(
				        	'menu' => 'handheld',
				            'theme_location' => 'handheld',
				            'depth' => 2,
				            'container' => true,
				            'menu_class' => 'nav navbar-nav navbar-right',
				            'fallback_cb' => 'wp_page_menu',
				            'walker' => new wp_bootstrap_navwalker())
				        );
				        ?>
				    </div>
				</div>
			</nav>
		</div>
		<?php
	}
}

if ( ! function_exists( 'storefront_secondary_navigation' ) ) {
	/**
	 * Display Secondary Navigation
	 * @since  1.0.0
	 * @return void
	 */
	function storefront_secondary_navigation() {
		?>
		<nav class="secondary-navigation" role="navigation" aria-label="<?php _e( 'Secondary Navigation', 'storefront' ); ?>">
			<?php
				wp_nav_menu(
					array(
						'theme_location'	=> 'secondary',
						'fallback_cb'		=> '',
					)
				);
			?>
		</nav><!-- #site-navigation -->
		<?php
	}
}

if ( ! function_exists( 'storefront_skip_links' ) ) {
	/**
	 * Skip links
	 * @since  1.4.1
	 * @return void
	 */
	function storefront_skip_links() {
		?>
		<a class="skip-link screen-reader-text" href="#site-navigation"><?php _e( 'Skip to navigation', 'storefront' ); ?></a>
		<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'storefront' ); ?></a>
		<?php
	}
}


