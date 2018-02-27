<?php
if ( ! isset( $content_width ) ) {
	$content_width = 750;
}

if ( ! function_exists( 'dw_store_setup' ) ) :
function dw_store_setup() {
	load_theme_textdomain( 'dw-store', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'title-tag' );

	add_theme_support( 'post-thumbnails' );

	add_theme_support( 'woocommerce' );

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'dw-store' ),
		'secondary' => __( 'Secondary Menu', 'dw-store' ),
	) );

	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

}
endif;
add_action( 'after_setup_theme', 'dw_store_setup' );

if ( ! function_exists( 'dw_store_register_required_plugins' ) ) :
function dw_store_register_required_plugins() {
	$plugins = array(
		array(
			'name'        => 'Unyson',
			'slug'        => 'unyson',
			'required'    => true
		),
		array(
			'name'        => 'WooCommerce',
			'slug'        => 'woocommerce',
			'required'    => true
		)
	);

	$config = array(
		'id'           => 'dw-store',
		'menu'         => 'dw-store-install-plugins'
	);
	tgmpa( $plugins, $config );
}
endif;
add_action( 'tgmpa_register', 'dw_store_register_required_plugins' );

if ( ! function_exists( 'dw_store_widgets_init' ) ) :
function dw_store_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'dw-store' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	if ( class_exists( 'Woocommerce' ) ) {
		register_sidebar( array(
			'name'          => __( 'Shop Header', 'dw-store' ),
			'id'            => 'shop-header',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
		register_sidebar( array(
			'name'          => __( 'Shop Sidebar', 'dw-store' ),
			'id'            => 'shop-sidebar',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
		register_sidebar( array(
			'name'          => __( 'Shop Filter', 'dw-store' ),
			'id'            => 'shop-filter',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}
	register_sidebar( array(
		'name'          => __( 'Footer 1', 'dw-store' ),
		'id'            => 'footer-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer 2', 'dw-store' ),
		'id'            => 'footer-2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer 3', 'dw-store' ),
		'id'            => 'footer-3',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer 4', 'dw-store' ),
		'id'            => 'footer-4',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'dw_store_widgets_init' );
endif;

function dw_store_search_form_modify( $html ) {
 	$html = str_replace( '<label>', '', $html );
	$html = str_replace( '</label>', '', $html );
	$html = str_replace( 'screen-reader-text', 'sr-only', $html );
	$html = str_replace( 'search-field"', 'form-control" autocomplete="off"', $html );
	$html = str_replace( 'search-submit', 'sr-only', $html );
  return $html;
}
add_filter( 'get_search_form', 'dw_store_search_form_modify' );

function dw_store_active( $selected, $current = true, $echo = true ){
	if ( (string) $selected === (string) $current ) {
		$result = 'active';
	} else {
		$result = '';
	}

	if ( $echo ) {
		echo esc_html( $result );
	}

	return $result;
}

function dw_store_get_theme_option( $option_name, $default = '' ) {
	if ( function_exists( 'fw_get_db_settings_option' ) ) {
		$options = fw_get_db_settings_option( $option_name );
	}
  if( isset( $options ) ) {
    return $options;
  }
  return $default;
}

function dw_store_filter_theme_option_type_icon_sets($sets) {
	$sets['social-icon-set'] = array(
		'font-style-src' => $sets['font-awesome']['font-style-src'],
		'container-class' => $sets['font-awesome']['container-class'],
		'groups' => array(
			'social' => __('Social Icons', 'fw'),
			),
		'icons' => array(
			'fa fa-facebook' => array('group' => 'social'),
			'fa fa-twitter' => array('group' => 'social'),
			'fa fa-google-plus' => array('group' => 'social'),
			'fa fa-youtube' => array('group' => 'social'),
			'fa fa-github' => array('group' => 'social'),
			'fa fa-weibo' => array('group' => 'social'),
			'fa fa-vk' => array('group' => 'social'),
			'fa fa-tumblr' => array('group' => 'social'),
			'fa fa-pinterest' => array('group' => 'social'),
			'fa fa-linkedin' => array('group' => 'social'),
			'fa fa-instagram' => array('group' => 'social'),
			'fa fa-flickr' => array('group' => 'social'),
			'fa fa-digg' => array('group' => 'social'),
			'fa fa-dribbble' => array('group' => 'social'),
			'fa fa-behance' => array('group' => 'social'),
			),
		);

	return $sets;
}
add_filter('fw_option_type_icon_sets', 'dw_store_filter_theme_option_type_icon_sets');

function dw_store_custom_extensions_menu( $data ) {
	add_menu_page(
		__( 'DW Store', 'fw' ),
		__( 'DW Store', 'fw' ),
		$data['capability'],
		$data['slug'],
		$data['content_callback'],
		get_template_directory_uri() . '/assets/img/dw-favicon_360.png',
		'59.5'
	);
	add_submenu_page(
		$data['slug'],
		__( 'Add-ons', 'fw' ),
		__( 'Add-ons', 'fw' ),
		$data['capability'],
		$data['slug'],
		$data['content_callback']
	);
}
add_action( 'fw_backend_add_custom_extensions_menu', 'dw_store_custom_extensions_menu' );

function dw_store_custom_theme_settings_menu( $data ) {
	add_submenu_page(
		'fw-extensions',
		__( 'Theme Settings', 'fw' ),
		__( 'Theme Settings', 'fw' ),
		$data['capability'],
		$data['slug'],
		$data['content_callback']
	);
}
add_action( 'fw_backend_add_custom_settings_menu', 'dw_store_custom_theme_settings_menu' );

function dw_store_filter_admin_footer_text() {
	echo 'If you like DW Store please leave us a <a href="http://www.designwall.com/wordpress/themes/dw-store/#product_reivews">★★★★★</a> rating. A huge thank you from DesignWall in advance!';
}

function dw_store_filter_footer_version() {
	echo '';
}

add_filter( 'admin_footer_text', 'dw_store_filter_admin_footer_text', 12 );
add_filter( 'update_footer', 'dw_store_filter_footer_version', 12 );
