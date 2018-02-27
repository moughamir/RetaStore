<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$manifest = array();

$manifest['name'] = __('DW Store', 'fw');

$manifest['id'] = 'start';

$manifest['supported_extensions'] = array(
	'page-builder' => array(),
	'megamenu' => array(),
	'sidebars' => array(),
	'slider' => array(),
	'breadcrumbs' => array(),
);
