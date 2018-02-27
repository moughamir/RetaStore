<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'style'   => array(
		'type'    => 'select',
		'label'   => __('Box Style', 'fw'),
		'choices' => array(
			'fw-iconbox-1' => __('Icon above title', 'fw'),
			'fw-iconbox-2' => __('Icon in line with title', 'fw')
		)
	),
	'icon'    => array(
		'type'  => 'icon',
		'label' => __('Choose an Icon', 'fw'),
	),
	'title'   => array(
		'type'  => 'text',
		'label' => __( 'Title of the Box', 'fw' ),
	),
	'content' => array(
		'type'  => 'textarea',
		'label' => __( 'Content', 'fw' ),
		'desc'  => __( 'Enter the desired content', 'fw' ),
	),
	'background_color' => array(
		'type'  => 'color-picker',
		'label' => __( 'Background Color', 'fw' ),
		'desc'  => __( 'Please select the background color', 'fw' ),
	),
	'icon_color' => array(
		'type'  => 'color-picker',
		'label' => __( 'Icon Color', 'fw' ),
		'desc'  => __( 'Please select the icon color', 'fw' ),
	),
	'title_color' => array(
		'type'  => 'color-picker',
		'label' => __( 'Title Color', 'fw' ),
		'desc'  => __( 'Please select the title color', 'fw' ),
	),
	'content_color' => array(
		'type'  => 'color-picker',
		'label' => __( 'Content Color', 'fw' ),
		'desc'  => __( 'Please select the content color', 'fw' ),
	),
	'padding' => array(
		'type'  => 'text',
		'label' => __( 'Padding', 'fw' ),
	),
);
