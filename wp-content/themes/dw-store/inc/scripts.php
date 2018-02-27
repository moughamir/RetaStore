<?php
if ( ! function_exists( 'dw_store_scripts' ) ) :
function dw_store_scripts() {
	global $wp_version;
	$version = wp_get_theme( wp_get_theme()->template )->get( 'Version' );

	if ( defined( 'WP_ENV' ) && 'development' === WP_ENV ) {
		$assets = array(
			'css' => '/assets/css/dw-store.css',
			'js'  => '/assets/js/dw-store.js',
		);
	} else {
		$assets = array(
			'css' => '/assets/css/dw-store.min.css',
			'js'  => '/assets/js/dw-store.min.js',
		);
	}

	wp_enqueue_style( 'dw-store-main', get_template_directory_uri() . $assets['css'], array(), $version );
	wp_enqueue_style( 'dw-store-style', get_stylesheet_uri() );
	wp_enqueue_style( 'dw-store-print', get_template_directory_uri() . '/assets/css/print.css', array(), $version, 'print' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_single( ) ) {
		wp_dequeue_script( 'prettyPhoto' );
		wp_dequeue_script( 'prettyPhoto-init' );
	}

	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/assets/js/modernizr.min.js', array(), $version, false );
	wp_enqueue_script( 'elevatezoom', get_template_directory_uri() . '/assets/js/jquery.elevateZoom-3.0.8.min.js', array(), $version, false );
	wp_enqueue_script( 'infinitescroll', get_template_directory_uri() . '/assets/js/jquery.infinitescroll.min.js', array(), '2.1.0', true );
	wp_enqueue_script( 'plugin', get_template_directory_uri() . '/assets/js/jquery.plugin.js', array(), $version, false );
	wp_enqueue_script( 'countdown', get_template_directory_uri() . '/assets/js/jquery.countdown.js', array(), $version, false );
	wp_enqueue_script( 'imagesloaded', get_template_directory_uri() . '/assets/js/imagesloaded.pkgd.min.js', array(), '3.1.8', false );
	wp_enqueue_script( 'dw-store-script', get_template_directory_uri() . $assets['js'], array( 'jquery' ), $version, true );
	wp_enqueue_script( 'masonry' );

	wp_localize_script( 'dw-store-script', 'dw_store_script', array(
		'ajax_url' => admin_url( 'admin-ajax.php' ),
		'loading_src' => get_template_directory_uri().'/assets/img/loading.gif' )
	);
}
endif;
add_action( 'wp_enqueue_scripts', 'dw_store_scripts' );

if ( ! function_exists( 'dw_store_admin_scripts' ) ) {
	function dw_store_admin_scripts() {
		global $wp_version;
		$version = wp_get_theme( wp_get_theme()->template )->get( 'Version' );
		$screen = get_current_screen();

		if ( 'product_cat' == $screen->taxonomy && 'product' == $screen->post_type  ) {
			wp_enqueue_script( 'dw-store-admin', get_template_directory_uri() . '/assets/js/dw-store-admin.js', array( 'jquery' ), $version, true );
		}
		wp_enqueue_style( 'dw-store-admin-css', get_template_directory_uri() . '/assets/css/dw-store-admin.css' );
	}
	add_action( 'admin_enqueue_scripts', 'dw_store_admin_scripts' );
}

if ( ! function_exists( 'dw_store_custom_css' ) ) :
function dw_store_custom_css() {
	$custom_css = '';

	if ( dw_store_get_theme_option( 'text_typography' ) ) {
		$custom_css .= dw_store_print_typography_css( 'body', 'text_typography' );
	}

	if ( dw_store_get_theme_option( 'heading_typography' ) ) {
		$custom_css .= dw_store_print_typography_css( 'h1, h2, h3, h4, h5, h6', 'heading_typography' );
	}

	if ( dw_store_get_theme_option( 'link_color' ) ) {
		$custom_css .= 'a { color: ' . dw_store_get_theme_option( 'link_color' ) . ' } ';
		$custom_css .= 'div.fw-tabs-container .fw-tabs ul li.ui-state-active a { border-bottom-color: ' . dw_store_get_theme_option( 'link_color' ) . ' !important; } ';
		$custom_css .= '.btn-primary { background-color: ' . dw_store_get_theme_option( 'link_color' ) . '; border-color: ' . dw_store_get_theme_option( 'link_color' ) . ' } ';
	}

	if ( dw_store_get_theme_option( 'link_hover_color' ) ) {
		$custom_css .= 'a:hover, a:active, .hentry .entry-title a:hover, .hentry .entry-title a:active, 
		.hentry .entry-meta a:hover, .post-navigation .nav-links .nav-previous a:hover,
		.post-navigation .nav-links .nav-next a:hover, .site-navbar .sub-menu  li  a:hover, 
		.posts-list .list-unstyled .entry-title:hover, .breadcrumbs a:hover, .breadcrumbs a:active,
		.dropdown-menu .active a, .dropdown .dropdown-menu li a:hover, .custom-menu ul li a:hover,
		.product_list_widget li .product-title:hover  { color: ' . dw_store_get_theme_option( 'link_hover_color' ) . ' } ';
		$custom_css .= '.site-navbar .navbar-nav .sub-menu > li > a:hover, .site-navbar .navbar-nav .sub-menu > li > a:active { color: ' . dw_store_get_theme_option( 'link_hover_color' ) . '} ';
		$custom_css .= '.btn-primary:hover, .btn-primary:active, .btn-primary:focus { background-color: ' . dw_store_get_theme_option( 'link_hover_color' ) . '; border-color: ' . dw_store_get_theme_option( 'link_hover_color' ) . ' } ';
	}

	if ( dw_store_get_theme_option( 'topbar_background' ) ) {
		$custom_css .= '.site-topbar, .site-topbar.topbar-inverse { background-color: ' . dw_store_get_theme_option( 'topbar_background' ) . ' } ';
	}

	if ( dw_store_get_theme_option( 'navbar_background' ) ) {
		$custom_css .= '.site-navbar { background-color: ' . dw_store_get_theme_option( 'navbar_background' ) . ' } ';
	}

	if ( dw_store_get_theme_option( 'footer_background' ) ) {
		$custom_css .= '.site-footer, .site-footer.footer-inverse { background-color: ' . dw_store_get_theme_option( 'footer_background' ) . ' } ';
	}

	if ( $custom_css ) {
		echo '<style type="text/css">' . esc_html( $custom_css ) . '</style>';
	}
}
endif;
add_action( 'wp_head', 'dw_store_custom_css' );

if ( ! function_exists( 'dw_store_process_google_fonts' ) ) :
function dw_store_process_google_fonts() {
	$include_from_google = array();
	$google_fonts = fw_get_google_fonts();

	$text_typography = dw_store_get_theme_option( 'text_typography' );
	if ( isset ( $google_fonts[$text_typography['family']] ) ) {
		$include_from_google[$text_typography['family']] = $google_fonts[$text_typography['family']];
	}

	$heading_typography = dw_store_get_theme_option( 'heading_typography' );
	if ( isset ( $google_fonts[$heading_typography['family']] ) ) {
		$include_from_google[$heading_typography['family']] = $google_fonts[$heading_typography['family']];
	}

	$google_fonts_links = fw_theme_get_remote_fonts( $include_from_google );

	update_option( 'fw_theme_google_fonts_link', $google_fonts_links );
}
add_action( 'fw_settings_form_saved', 'dw_store_process_google_fonts', 999, 2 );
endif;

if ( ! function_exists( 'fw_theme_get_remote_fonts' ) ) :
function fw_theme_get_remote_fonts( $include_from_google ) {
	if ( ! sizeof ( $include_from_google ) ) {
		return '';
	}
	$html = "<link href='http://fonts.googleapis.com/css?family=";
	foreach ( $include_from_google as $font => $styles ) {
		$html .= str_replace ( ' ', '+', $font ) . ':' . implode( ',', $styles['variants'] ) . '|';
	}
	$html = substr( $html, 0, - 1 );
	$html .= "' rel='stylesheet' type='text/css'>";

	return $html;
}
endif;

if ( ! function_exists( 'dw_store_print_google_fonts_link' ) ) :
function dw_store_print_google_fonts_link() {
	$google_fonts_link = get_option( 'fw_theme_google_fonts_link', '' );
	if ( $google_fonts_link != '' ) {
		echo $google_fonts_link;
	}
}
add_action('wp_head', 'dw_store_print_google_fonts_link');
endif;
