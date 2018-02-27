<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'woocommerce' => array(
		'title'   => __( 'WooCommerce', 'dw-store' ),
		'type'    => 'tab',
		'options' => array(
			'general-box' => array(
				'title'   => __( 'WooCommerce Settings', 'dw-store' ),
				'type'    => 'box',
				'options' => array(
					'turning_sidebar' => array(
						'type'         => 'multi-picker',
						'label'        => false,
						'desc'         => false,
						'show_borders' => false,
						'picker'       => array(
							'turning_sidebar' => array(
								'label'   => __( 'Turn On / Off Sidebar', 'unyson' ),

								'type'    => 'switch',
								'right-choice' => array(
									'value' => 'on',
									'label' => __('On', 'fw')
									),
								'left-choice' => array(
									'value' => 'off',
									'label' => __('Off', 'fw')
									),
								)
							),
						'choices'      => array(
							'on' => array(
							'sidebar_position' => array(
								'type'    => 'short-select',

								'label'   => __( 'Select Sidebar Position', 'unyson' ),
								'value' => 'left',
								'choices' => array(
									'left' => __( 'Left', 'unyson' ),
									'right' => __( 'Right', 'unyson' ),
									)
								)
							),
							)
						),

					'products_listing_layout'       => array(
						'type'         => 'multi-picker',
						'label'        => false,
						'desc'         => false,
						'show_borders' => false,
						'picker'       => array(
							'products_listing_layout' => array(
								'label'   => __( 'Products Listing Layout', 'unyson' ),

								'type'    => 'short-select',
								'value' => 'grid',
								'choices' => array(
									'list'  => __( 'List', 'unyson' ),
									'grid' => __( 'Grid', 'unyson' )
									)
								)
							),
						'choices'      => array(
							'grid' => array(
								'columns' => array(
									'type'    => 'short-select',
									'label'   => __( 'Number of Columns', 'unyson' ),

									'value' => '4',
									'choices' => array(
										'2' => __( '2', 'unyson' ),
										'3' => __( '3', 'unyson' ),
										'4' => __( '4', 'unyson' ),
										)
									)
								),
							),

						),
					'products_navigation' => array(
						'label' => 'Products Navigation',

						'type'  => 'radio',
						'value' => 'paging',
						'choices' => array(
							'paging'  => __( 'Paging', 'unyson' ),
							'next_previous' => __( 'Next / Previous', 'unyson' ),
							'infinite_scroll' => __( 'Infinite Scroll', 'unyson' ),
							),
						'inline' => true
						),


					)
),
)
)
);
