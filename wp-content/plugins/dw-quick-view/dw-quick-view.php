<?php
/**
 *  Plugin Name: DW Woocommerce Quick View
 *  Description: A WordPress plugin allows your users to have a quick look about products.
 *  Author: DesignWall
 *  Author URI: http://www.designwall.com
 *  Version: 1.0
 *  Text Domain: dwqv
 */


if ( !defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

if ( ! function_exists( 'is_plugin_active' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}



 // Define constant for plugin info 
if ( ! defined( 'DWQV_DIR' ) ) {
	define( 'DWQV_DIR', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'DWQV_URI' ) ) {
	define( 'DWQV_URI', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'DWQV_VERSION' ) ){
	define( 'DWQV_VERSION', '1.0' );
}


function dwqv_install_woocommerce_admin_notice() {
	?>
	<div class="error">
		<p><?php _e( 'DW Quick View is enabled but not effective. It requires Woocommerce in order to work.', 'dwqv' ); ?></p>
	</div>
	<?php
}

function dwqv_install() {
	if ( ! function_exists( 'WC' ) ) {
		add_action( 'admin_notices', 'dwqv_install_woocommerce_admin_notice' );
	}
}
add_action( 'plugins_loaded', 'dwqv_install', 11 );

register_activation_hook( __FILE__, 'dwqv_install' );


// add button
function dwqv_add_button() {
	global $product;

	// $options = get_option( 'dwqv_settings_settings' );
	// if ( is_array( $options ) ) {
	// 	$label = $options['dwqv_settings_general_button_label'];
	// } else {
		$label = 'Quick View';
	// }
	
	echo '<a href="'.get_the_permalink().'#quickview" rel="nofollow" data-product_id="'.$product->id.'" class="quickview dwqv-button button" title="Product quick view">'.$label.'</a>';
}
add_action( 'woocommerce_after_shop_loop_item', 'dwqv_add_button', 15 );


function dwqv_scripts() {
	if ( class_exists( 'Woocommerce' ) ) {
		global $woocommerce;

		wp_enqueue_script( 'prettyPhoto', $woocommerce->plugin_url() . '/assets/js/prettyPhoto/jquery.prettyPhoto.min.js', array( 'jquery' ), '3.1.5', true );
		wp_enqueue_style( 'woocommerce_prettyPhoto_css', $woocommerce->plugin_url() . '/assets/css/prettyPhoto.css' );

		$suffix         = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		$frontend_script_path   = $woocommerce->plugin_url() . '/assets/js/frontend/';
		if ( ! wp_script_is( 'wc-add-to-cart-variation' ) ) {
			wp_register_script( 'wc-add-to-cart-variation', $frontend_script_path . 'add-to-cart-variation' . $suffix . '.js', array( 'jquery' ), $woocommerce->version, true );
			wp_enqueue_script( 'wc-add-to-cart-variation' );
		}
	}
	wp_enqueue_style( 'dwqv-style', DWQV_URI . '/assets/css/front-end.css', array(), DWQV_VERSION );
	wp_enqueue_script( 'dwqv-script', DWQV_URI . '/assets/js/front-end.js', array( 'jquery' ), DWQV_VERSION, true );

	wp_localize_script( 'dwqv-script', 'dwqv_script', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'wp_enqueue_scripts', 'dwqv_scripts' );

//ajax get product content

function dw_product_quickview(){
	global $product, $post, $woocommerce;
	if ( ! isset( $_GET['product_id'] ) ) {
		wp_die( 0 );
	}
	$p_id = $_GET['product_id'];
	$p = get_product( $p_id );
	$product = $p;
	$post = $p;

	woocommerce_get_template( 'content-single-product.php' );
	wp_die();
}
add_action( 'wp_ajax_dw-product-quickview', 'dw_product_quickview' );
add_action( 'wp_ajax_nopriv_dw-product-quickview', 'dw_product_quickview' );

//Set Modal quickview template

function dw_quick_view() {
	wc_get_template( 'dwqv-modal.php', array(), '', DWQV_DIR . 'templates/' );
}
add_action( 'wp_footer', 'dw_quick_view' );

//Overide Woo Template via Plugin

function dw_woo_adon_plugin_template( $template, $template_name, $template_path ) {
	global $woocommerce;
	$_template = $template;
	if ( ! $template_path ) 
		$template_path = $woocommerce->template_url;

	$plugin_path  = untrailingslashit( plugin_dir_path( __FILE__ ) )  . '/woocommerce/';

	// Look within passed path within the theme - this is priority
	$template = locate_template(
		array(
			$template_path . $template_name,
			$template_name
			)
		);

	if( ! $template && file_exists( $plugin_path . $template_name ) )
		$template = $plugin_path . $template_name;

	if ( ! $template )
		$template = $_template;

	return $template;
}
add_filter( 'woocommerce_locate_template', 'dw_woo_adon_plugin_template', 1, 3 );

