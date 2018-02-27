<?php if ( ! defined( 'FW' )) die( 'Forbidden' );

$options = array(
	'title' => array(
		'label' => __( 'Title', 'fw' ),
		'value' => 'Products',
		'type' => 'text',
		),
	'numbers' => array(
		'label' => __( 'Numbers', 'fw' ),
		'desc' => __( 'Number of products to show', 'fw' ),
		'value' => 5,
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

	'show' => array(
		'label' => __( 'Show', 'fw' ),
		'type'    => 'select',
		'choices' => array(
			''      => __( 'All Products', 'fw'),
			'featured' => __( 'Feature Products', 'fw' ),
			'onsale' => __( 'On-Sale Products', 'fw' ),
			)
		),

	'orderby' => array(
		'label' => __( 'Order By', 'fw' ),
		'type'    => 'select',
		'choices' => array(
			'date'   => __( 'Date', 'fw' ),
			'price'  => __( 'Price', 'fw' ),
			'rand'   => __( 'Random', 'fw' ),
			'sales'  => __( 'Sales', 'fw' ),
			)
		),

	'order' => array(
		'label' => __( 'Sorting order', 'fw' ),
		'type'    => 'select',
		'choices' => array(
			'asc'  => __( 'ASC', 'fw' ),
			'desc' => __( 'DESC', 'fw' ),
			)
		),

	'hide_free' => array(
		'label' => __( 'Hide free products', 'fw' ),
		'type'    => 'switch',
		),

	'show_hidden' => array(
		'label' => __( 'Show hidden products', 'fw' ),
		'type'    => 'switch',
		),

	'show_rating' => array(
		'label' => __( 'Show rating products', 'fw' ),
		'type'    => 'switch',
		),

	);
