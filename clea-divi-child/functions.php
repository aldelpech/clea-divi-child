<?php
/**
 * @package    clea-divi-child
 * @subpackage Functions
 * @version    1.0
 * @since      0.1.0
 * @author     Anne-Laure Delpech <ald.kerity@gmail.com>  
 * @copyright  Copyright (c) 2017 7Anne-Laure Delpech
 * @link       http://knowledge.parcours-performance.com
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */


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


/******
* Code added by AL (CLEA) to the original child theme
*/

// To require a file which is somewhere in this child theme directory
// require_once( trailingslashit( get_stylesheet_directory() ) . 'widgets.php' );

/***** a shortcode to add category title and description ***********/
function cdc_shortcode($atts = [], $content = null)
{

	// Display category title and description
	$content = '<header class="archive-header">' ;
	$content .= '<h1 class="entry-title main_title">' . single_cat_title( '', false ) . "</h1>" ;
	$content .= '<div class="archive-meta">' . category_description() . "</div></header>" ;

    // always return
    return $content;
}
add_shortcode('display_cat_title_description', 'cdc_shortcode');


// A titre d'essai - ne fonctionne pas... 
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