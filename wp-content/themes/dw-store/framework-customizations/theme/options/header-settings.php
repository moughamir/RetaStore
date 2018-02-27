<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'header' => array(
		'title' => __( 'Header', 'dw-store' ),
		'type' => 'tab',
		'options' => array(
			'general-box' => array(
				'title' => __( 'Header Settings', 'dw-store' ),
				'type' => 'box',
				'options' => array(
					'favicon' => array(
						'label' => __( 'Favicon', 'dw-store' ),
						'desc' => __( 'Upload a favicon image', 'dw-store' ),
						'type' => 'upload'
					),
					'logo' => array(
						'label' => __( 'Logo Image', 'dw-store' ),
						'desc' => __( 'Upload a logo image', 'dw-store' ),
						'type' => 'upload'
					),
					'topbar_style' => array(
						'label' => __( 'Topbar Style', 'dw-store' ),
						'type' => 'short-select',
						'value' => 'dark',
						'choices' => array(
							'dark' => 'Dark',
							'light' => 'Light'
						)
					),
					'topbar_background' => array(
						'label' => __( 'Topbar Background', 'dw-store' ),
						'type'  => 'color-picker',
					),
					'navbar_style' => array(
						'label' => __( 'Navbar Style', 'dw-store' ),
						'type' => 'short-select',
						'value' => 'dark',
						'choices' => array(
							'dark' => 'Dark',
							'light' => 'Light'
						)
					),
					'navbar_background' => array(
						'label' => __( 'Navbar Background', 'dw-store' ),
						'type'  => 'color-picker',
					),
				)
			),
		)
	)
);
