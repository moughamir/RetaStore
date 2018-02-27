<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}


function _filter_theme_add_hind_google_font($fonts) {
	$fonts['Roboto']  = array(
		'family'    => 'Roboto',
		'variants'  => array(
			'100', '100italic', '300', '300italic', '400', '400italic', '500', '500italic', '700', '700italic', '900', '900italic'
		),
	);
	ksort($fonts);
	return $fonts;
}
add_filter('fw_google_fonts', '_filter_theme_add_hind_google_font');


$options = array(
	fw()->theme->get_options( 'general-settings' ),
	fw()->theme->get_options( 'header-settings' ),
	fw()->theme->get_options( 'footer-settings' ),
	fw()->theme->get_options( 'woocommerce-settings' ),
	fw()->theme->get_options( 'social-settings' ),
);


