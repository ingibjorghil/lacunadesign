<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Lacuna_Design
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'lacunadesign' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div id="top-nav" class="hidden-xs">
			<nav class="navbar navbar-top navbar-default" role="navigation">
			    <div class="container nav-content">
				    <div id="navbar-top" class="collapse navbar-collapse navbar-ex3-collapse">
				        <?php
				        wp_nav_menu( array(
				        	'menu' => 'top-nav',
				            'theme_location' => 'top-nav',
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
				        	'menu' => 'mobile-nav',
				            'theme_location' => 'mobile-nav',
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
		
	</header>

	<div id="content" class="site-content">
