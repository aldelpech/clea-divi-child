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

/***** My shortcode with parameters for category title and description ***********/
// 	[cat_display title="yes" centrer="yes" description="yes"] will display both category and description
// source https://developer.wordpress.org/plugins/shortcodes/enclosing-shortcodes/

function cdc_cat_title_desc_shortcode( $atts = [], $content = null ) {
    // normalize attribute keys, lowercase
    $atts = array_change_key_case((array)$atts, CASE_LOWER);
 
    // override default attributes with user attributes
    $wporg_atts = shortcode_atts( [
                                     'title' 		=> 'yes',
									 'centrer'		=> 'yes',
									 'description' 	=> 'yes',
                                 ], $atts );
 
	// start output
    $o = '';
 
    // start box
    $o .= '<header class="archive-header">';
 
    // title
	if ( "yes" == $wporg_atts['title'] ) {
			
			if ( "yes" == $wporg_atts['centrer'] ) {
				$o .= '<h1 class="entry-title main_title" style="text-align:center;">' . single_cat_title( '', false ) . "</h1>";
			} else {
				$o .= '<h1 class="entry-title main_title">' . single_cat_title( '', false ) . "</h1>";
			}
	} else {
		$o .="";
	}

	if ( "yes" == $wporg_atts['description'] ) {
		    $o .= '<div class="archive-meta">' . category_description() . "</div>";
	} else {
		$o .="";
	}
 
    // end box
    $o .= '</header>';
 
    // return output
    return $o;
	

}
 
add_shortcode('cat_display', 'cdc_cat_title_desc_shortcode');



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