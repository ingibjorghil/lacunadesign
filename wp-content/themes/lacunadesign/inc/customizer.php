<?php
/**
 * Lacuna Design Theme Customizer.
 *
 * @package Lacuna_Design
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function lacunadesign_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'lacunadesign_customize_register' );

function lacunadesign_customizer($wp_customize){
	$wp_customize->add_section( 'themeslug_logo_section' , array(
    'title'       => __( 'Logo', 'Lacuna Design' ),
    'priority'    => 30,
    'description' => 'Upload customized logo to replace site name in the header',
) );

	$wp_customize->add_setting( 'themeslug_logo' );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themeslug_logo', array(
    'label'    => __( 'Logo', 'themeslug' ),
    'section'  => 'themeslug_logo_section',
    'settings' => 'themeslug_logo',
) ) );
}
add_action( 'customize_register', 'lacunadesign_customizer' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function lacunadesign_customize_preview_js() {
	wp_enqueue_script( 'lacunadesign_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'lacunadesign_customize_preview_js' );
