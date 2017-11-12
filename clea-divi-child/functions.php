<?php
/**
 * @package    clea-divi-child
 * @subpackage Functions
 * @version    1.0.1
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
    $o .= '<div class="et_pb_section  et_pb_section_0 et_section_regular"><div class=" et_pb_row et_pb_row_0"><div class="et_pb_column et_pb_column_4_4  et_pb_column_0 et-last-child">';

	/* 
	* @since      1.0.1
	* Display optional category image 
	* (if Categories Images By Muhammad Said El Zahlan is used) 
	* Source http://zahlan.net/blog/2012/06/categories-images/ 
	*/

	
	 $img_cat = "" ;
	if ( function_exists( 'z_taxonomy_image_url' ) ) {
		
		$attr = array(
			'class' => 'category_image',
			'alt' => 'image alt',
			'height' => 200,
			'title' => single_cat_title( '', false ),
		);
		
		$o .= '<div class="et_pb_module et_pb_image et_pb_image_0 et_always_center_on_mobile"><span class="et_pb_image_wrap">' ;
		$o .= '<img src="' ;
		$o .= z_taxonomy_image_url();
		$o .= '" alt=""/></span></div>' ;
	} 
	
	/* 
	* @since      1.0.0
	* Display title 
	*/    

	if ( "yes" == $wporg_atts['title'] ) {

		$title_style = "" ;	
	
		if ( "yes" == $wporg_atts['centrer'] ) {
		
			$title_style = ' style="text-align:center;"' ;
		}
		
		$o .= '<div class="et_pb_text et_pb_module et_pb_bg_layout_light et_pb_text_align_left  et_pb_text_0"><div class="et_pb_text_inner">' ;
		$o .= '<h1 class="entry-title main_title"' . $title_style . '>' ;
		$o .= single_cat_title( '', false ) ;
		$o .= '</h1>' ;
		$o .= '	</div> </div> ' ;
		
	} else {
		$o .="";
	}

	if ( "yes" == $wporg_atts['description'] ) {
		
		$o .= '<div class="et_pb_text et_pb_module et_pb_bg_layout_light et_pb_text_align_left  et_pb_text_1"><div class="et_pb_text_inner">';
		$o .= category_description();
		$o .='	</div></div> ';
		
	} else {
		$o .="";
	}


    // end box
    $o .= '</div> </div> </div>';
 
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