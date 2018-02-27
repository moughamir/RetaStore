<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'footer' => array(
		'title' => __( 'Footer', 'dw-store' ),
		'type' => 'tab',
		'options' => array(
			'general-box' => array(
				'title' => __( 'Header Settings', 'dw-store' ),
				'type' => 'box',
				'options' => array(
					'footer_style' => array(
						'label' => __( 'Footer Style', 'dw-store' ),
						'type' => 'short-select',
						'value' => 'dark',
						'choices' => array(
							'dark' => 'Dark',
							'light' => 'Light'
							)
						),
					'footer_background' => array(
						'label' => __( 'Footer Background', 'dw-store' ),
						'type'  => 'color-picker',
						),
					'footer_logo' => array(
						'label' => __( 'Footer Logo', 'dw-store' ),
						'type'  => 'upload',
						),
					'footer_copyright' => array(
						'label' => __( 'Footer Copyright', 'dw-store' ),
						'type' => 'textarea',
						'value' => 'Copyright © 2015.	Theme: DW Store by <a href="http://www.designwall.com" rel="designer">DesignWall</a>.<br>
Proudly powered by 	<a href="http://wordpress.org/">WordPress</a>',
						),
					)
				),
			)
		)
	);
