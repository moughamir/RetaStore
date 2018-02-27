<?php if (!defined('FW')) {
	die('Forbidden');
}

$options = array(
	'is_fullwidth' => array(
		'label'        => __('Full Width', 'fw'),
		'type'         => 'switch',
	),
	'remove_columns_gutter' => array(
		'label'        => __('Remove Columns Gutter', 'fw'),
		'desc'         => __('Remove space between columns?', 'fw'),
		'type'         => 'switch'
	),
	'background_color' => array(
		'label' => __('Background Color', 'fw'),
		'desc'  => __('Please select the background color', 'fw'),
		'type'  => 'color-picker',
	),
	'background_image' => array(
		'label'   => __('Background Image', 'fw'),
		'desc'    => __('Please select the background image', 'fw'),
		'type'    => 'background-image',
		'choices' => array(//	in future may will set predefined images
		)
	),
	'background_position' => array(
		'label'        => __('Background Position', 'fw'),
		'type'         => 'select',
		'choices' => array(
			'top left' => 'top left',
			'top right' => 'top right',
			'top center' => 'top center',
			'center' => 'center',
			'bottom left' => 'bottom left',
			'bottom right' => 'bottom right',
			'bottom center' => 'bottom center',
		)
	),
	'background_size' => array(
		'label'        => __('Background Size', 'fw'),
		'type'         => 'select',
		'choices' => array(
			'auto' => 'auto',
			'cover' => 'cover',
			'contain' => 'contain',
		)
	),
	'video' => array(
		'label' => __('Background Video', 'fw'),
		'desc'  => __('Insert Video URL to embed this video', 'fw'),
		'type'  => 'text',
	),
	'margin' => array(
		'label'        => __('Margin', 'fw'),
		'type'         => 'text'
	),
	'padding' => array(
		'label'        => __('Padding', 'fw'),
		'type'         => 'text'
	),
	'class' => array(
		'label'        => __('Custom Class', 'fw'),
		'type'         => 'text'
	),
);
