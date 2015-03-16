<?php
/**
 * Plugin Name: WooCommerce Advance Accordion
 * Plugin URI: http://www.beeplugins.com
 * Description: List WooCommerce product categories and subcategories into a toggle accordion with expand / collapse.
 * Version: 0.1
 * Author: aumsrini
 * Author URI: http://beeplugins.com/woocommerce-advance-accordion
 * Text Domain: wooadac
 * Domain Path: /languages/
*/

/* Loads Plugin Text Domain */
function wooadac_init() {
  load_plugin_textdomain( 'wooadac', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );	
}
add_action('init', 'wooadac_init');


/*-----------------------------------------------------------------------------------*/
/* Intialize Plugin scrits & styles */
/*-----------------------------------------------------------------------------------*/

add_action('wp_enqueue_scripts', 'reg_wooadac_scripts');
function reg_wooadac_scripts(){
	$wooadac = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));
	//wp_enqueue_style('wooadac_style', $wooadac.'assets/css/style.css', array(), '1.0');	
	wp_enqueue_script('wooadac_script', $wooadac.'assets/js/script.min.js', array('jquery'), '1.0');
	
}

/*-----------------------------------------------------------------------------------*/
/* Generating COLOR PICKER */
/*-----------------------------------------------------------------------------------*/

function wooadac_color_picker_scripts() {
wp_enqueue_style( 'wp-color-picker' );
wp_enqueue_script( 'iris', admin_url( 'js/iris.min.js' ), array( 'jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch' ), false, 1 );
wp_enqueue_script( 'cp-active', plugins_url('assets/js/color-picker.js', __FILE__), array('jquery'), '', true );

}

add_action( 'admin_enqueue_scripts', wooadac_color_picker_scripts);

// Custom Styles in Admin panel

include( plugin_dir_path( __FILE__ ) . 'includes/custom.php');
/*-----------------------------------------------------------------------------------*/
/* INCLUDE FILES: WooCommerce Advance Accordion Widget */
/*-----------------------------------------------------------------------------------*/

	include_once( 'includes/wooadac-widget.php' );	
	include_once( 'includes/wooadac-shortcode.php' );	
		
?>