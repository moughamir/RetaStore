<?php if ( ! defined( 'FW' )) die( 'Forbidden' );
$menus = wp_get_nav_menus();
$menu_array['0'] = 'Select';
foreach ( $menus as $menu ) {
	$menu_array[$menu->term_id] = $menu->name;
}

$options = array(
	'custom_menu' => array(
		'label' => __( 'Select Menu', 'fw' ),
		'value' => '',
		'type' => 'select',
		'choices' => $menu_array
	),
);
