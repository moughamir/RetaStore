<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'social' => array(
		'title'   => __( 'Social', 'dw-store' ),
		'type'    => 'tab',
		'options' => array(
			'general-box' => array(
				'title'   => __( 'Social Links', 'dw-store' ),
				'type'    => 'box',
				'options' => array(
					'social-setting' =>		array(
						'type' => 'addable-popup',
						'label' => __('Social Setting', 'fw'),
						'desc'  => __('Add Social link on footer', 'fw'),
						'template' => '{{- social }}',
						'popup-title' => null,
						'size' => 'small',
						'limit' => 0,
						'popup-options' => array(
							'social' => array(
								'label' => __('Social Network', 'fw'),
								'type' => 'icon',
								'set' => 'social-icon-set',
								),
							'social_link' => array(
								'label' => __('Social Link', 'fw'),
								'type' => 'text',
								'value' => '#',
								),
							),
						)
					)
				),
			)
		)
);
