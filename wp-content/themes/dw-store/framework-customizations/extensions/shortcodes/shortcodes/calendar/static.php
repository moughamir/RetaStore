<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$shortcodes_extension = fw_ext( 'shortcodes' );

wp_enqueue_style(
	'fw-shortcode-calendar-bootstrap3',
	$shortcodes_extension->get_declared_URI( '/shortcodes/calendar/static/libs/bootstrap3/css/bootstrap-grid.css' )
);
wp_enqueue_style(
	'fw-shortcode-calendar-calendar',
	$shortcodes_extension->get_declared_URI( '/shortcodes/calendar/static/css/calendar.css' )
);
wp_enqueue_style(
	'fw-shortcode-calendar',
	$shortcodes_extension->get_declared_URI( '/shortcodes/calendar/static/css/styles.css' )
);


wp_enqueue_script(
	'fw-shortcode-calendar-calendar',
	$shortcodes_extension->get_declared_URI( '/shortcodes/calendar/static/js/calendar.js' ),
	array( 'jquery', 'underscore' ),
	fw()->manifest->get_version(),
	true
);
wp_enqueue_script(
	'fw-shortcode-calendar',
	$shortcodes_extension->get_declared_URI( '/shortcodes/calendar/static/js/scripts.js' ),
	array( 'jquery', 'underscore', 'fw-shortcode-calendar-calendar' ),
	fw()->manifest->get_version(),
	true
);

$locale = get_locale();
wp_localize_script(
	'fw-shortcode-calendar',
	'fwShortcodeCalendarLocalize',
	array(
		'event'  => __( 'Event', 'fw' ),
		'events' => __( 'Events', 'fw' ),
		'today'  => __( 'Today', 'fw' ),
		'locale' => $locale
	)
);
