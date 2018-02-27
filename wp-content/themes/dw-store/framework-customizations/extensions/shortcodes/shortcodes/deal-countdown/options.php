<?php if ( ! defined( 'FW' )) die( 'Forbidden' );

$options = array(
	'title' => array(
		'label' => __( 'Title', 'fw' ),
		'value' => 'Deal Countdown',
		'type' => 'text',
		),
	'numbers' => array(
		'label' => __( 'Numbers', 'fw' ),
		'desc' => __( 'Number of products to show', 'fw' ),
		'value' => 2,
		'type' => 'text',
	),
	'col_num' => array(
	'label' => __( 'Columns', 'fw' ),
	'desc' => __( 'Number of columns', 'fw' ),
	'value' => 2,
	'type' => 'text',
	),
);
