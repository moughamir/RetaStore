<?php if ( ! defined( 'FW' )) die( 'Forbidden' );

$options = array(
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

	'cat_id' => array(
		'label' => __( 'Category :', 'fw' ),
		'type'    => 'multi-select',
		'population' => 'taxonomy',
    'source' => 'product_cat',
		),

	'tag_id' => array(
		'label' => __( 'Tags :', 'fw' ),
		'type'    => 'multi-select',
		'population' => 'taxonomy',
    'source' => 'product_tag',
		),

);
