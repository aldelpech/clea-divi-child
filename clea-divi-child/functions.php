<?php
/**
 * @author Divi Space
 * @copyright 2017
 */
if (!defined('ABSPATH')) die();

function ds_ct_enqueue_parent() { wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' ); }

function ds_ct_loadjs() {
	wp_enqueue_script( 'ds-theme-script', get_stylesheet_directory_uri() . '/ds-script.js',
        array( 'jquery' )
    );
}

add_action( 'wp_enqueue_scripts', 'ds_ct_enqueue_parent' );
add_action( 'wp_enqueue_scripts', 'ds_ct_loadjs' );

include('login-editor.php');



function custom_colors_css() {
	
	global $themename, $shortname, $options;
	$et_theme_options_name = 'et_' . $themename;
	$al_et_options = get_option( $et_theme_options_name );
	return $al_et_options ;
	
	// divi_color_palette
	// global $themename
	// 
	// global $themename, $shortname, $options;
	// $et_theme_options_name = 'et_' . $shortname;
	// $et_theme_options = get_option( $et_theme_options_name );
}

?>