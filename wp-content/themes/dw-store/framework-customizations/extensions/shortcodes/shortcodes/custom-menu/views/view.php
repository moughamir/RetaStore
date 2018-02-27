<?php if (!defined('FW')) die('Forbidden');

$custom_menu = isset( $atts['custom_menu'] ) ? $atts['custom_menu'] : '';
$nav_menu = wp_get_nav_menu_object( $custom_menu );
if ( !$nav_menu )
	return;

$nav_menu_args = array(
	'fallback_cb' => '',
	'menu'        => $nav_menu
);
?>
<div class="custom-menu">
<?php
wp_nav_menu( apply_filters( 'widget_nav_menu_args', $nav_menu_args, $nav_menu, '' ) );
?>
</div>

