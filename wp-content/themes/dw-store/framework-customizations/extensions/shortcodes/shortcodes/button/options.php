<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'label'  => array(
		'label' => __( 'Button Label', 'fw' ),
		'desc'  => __( 'This is the text that appears on your button', 'fw' ),
		'type'  => 'text',
		'value' => 'Submit'
	),
	'link'   => array(
		'label' => __( 'Button Link', 'fw' ),
		'desc'  => __( 'Where should your button link to', 'fw' ),
		'type'  => 'text',
		'value' => '#'
	),
	'target' => array(
		'type'  => 'switch',
		'label'   => __( 'Open Link in New Window', 'fw' ),
		'desc'    => __( 'Select here if you want to open the linked page in a new window', 'fw' ),
		'right-choice' => array(
			'value' => '_blank',
			'label' => __('Yes', 'fw'),
		),
		'left-choice' => array(
			'value' => '_self',
			'label' => __('No', 'fw'),
		),
	),
	'is_fullwidth' => array(
		'type'  => 'switch',
		'label'   => __( 'Full Width', 'fw' )
	),
	'style'  => array(
		'label'   => __( 'Button Style', 'fw' ),
		'desc'    => __( 'Choose a style for your button', 'fw' ),
		'type'    => 'select',
		'choices' => array(
			'btn-default'      => __( 'Default', 'fw'),
			'btn-primary' => __( 'Primary', 'fw' ),
			'btn-success'  => __( 'Success', 'fw' ),
			'btn-info' => __( 'Info', 'fw' ),
			'btn-warning'   => __( 'Warning', 'fw' ),
			'btn-danger'   => __( 'Danger', 'fw' ),
		)
	),
	'size'  => array(
		'label'   => __( 'Button Size', 'fw' ),
		'desc'    => __( 'Choose a size for your button', 'fw' ),
		'type'    => 'select',
		'choices' => array(
			''      => __( 'Medium', 'fw'),
			'btn-lg' => __( 'Large', 'fw' ),
			'btn-sm'  => __( 'Small', 'fw' ),
			'btn-xs' => __( 'Extra Small', 'fw' ),
		)
	),
);
