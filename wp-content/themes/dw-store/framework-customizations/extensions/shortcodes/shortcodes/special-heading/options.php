<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'title'    => array(
		'type'  => 'text',
		'label' => __( 'Heading Title', 'fw' ),
		'desc'  => __( 'Write the heading title content', 'fw' ),
	),
	'subtitle' => array(
		'type'  => 'text',
		'label' => __( 'Heading Subtitle', 'fw' ),
		'desc'  => __( 'Write the heading subtitle content', 'fw' ),
	),
	'heading' => array(
		'type'    => 'select',
		'label'   => __('Heading Size', 'fw'),
		'choices' => array(
			'h1' => 'H1',
			'h2' => 'H2',
			'h3' => 'H3',
			'h4' => 'H4',
			'h5' => 'H5',
			'h6' => 'H6',
		)
	),
	'heading_color' => array(
		'label' => __('Heading Color', 'fw'),
		'desc'  => __('Please select the heading color', 'fw'),
		'type'  => 'color-picker',
	),
	'centered' => array(
		'type'    => 'switch',
		'label'   => __('Centered', 'fw'),
	)
);
