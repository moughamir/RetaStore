<?php if ( ! defined( 'FW' )) die( 'Forbidden' );

$options = array(
	'numbers' => array(
		'label' => __( 'Numbers', 'fw' ),
		'desc' => __( 'Number of posts to show', 'fw' ),
		'value' => 2,
		'type' => 'text',
		),

	'col_num' => array(
		'label' => __( 'Columns', 'fw' ),
		'desc' => __( 'Number of columns', 'fw' ),
		'value' => 2,
		'type' => 'text',
		),

	'show_content' => array(
		'label' => __( 'Display post content?', 'fw' ),
		'type'    => 'select',
		'choices' => array(
			'excerpt'      => __( 'Excerpt', 'fw'),
			'content' => __( 'Content', 'fw' ),
			)
		),

	'cat_id' => array(
		'label' => __( 'Category :', 'fw' ),
		'type'    => 'multi-select',
		'population' => 'taxonomy',
    'source' => 'category',
		),

	'tag_id' => array(
		'label' => __( 'Tags :', 'fw' ),
		'type'    => 'multi-select',
		'population' => 'taxonomy',
    'source' => 'post_tag',
		),

	'show_date' => array(
		'label' => __( 'Display post date?', 'fw' ),
		'type'    => 'switch',
		),

	'show_author' => array(
		'label' => __( 'Display post author?', 'fw' ),
		'type'    => 'switch',
		),

	'show_comment' => array(
		'label' => __( 'Display comment count?', 'fw' ),
		'type'    => 'switch',
		),
	);
