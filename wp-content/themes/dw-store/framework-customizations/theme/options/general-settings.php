<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'general' => array(
		'title'   => __( 'General', 'dw-store' ),
		'type'    => 'tab',
		'options' => array(
			'general-box' => array(
				'title'   => __( 'General Settings', 'dw-store' ),
				'type'    => 'box',
				'options' => array(
					'site_layout' => array(
						'type'    => 'short-select',
						'label'   => __( 'Site Layout', 'dw-store' ),
						'value' => 'right',

						'choices' => array(
							'full-width' => __( 'Full-Width', 'dw-store' ),
							'fixed-width' => __( 'Fixed-width', 'dw-store' )
						)
					),
					'text_typography' => array(
						'label' => __( 'Text', 'dw-store' ),
						'type'  => 'typography',
						'value' => array(
							'size'   => 14,
							'family' => 'Roboto',
							'style'  => '400',
							'color'  => '#666'
						)
					),
					'heading_typography' => array(
						'label' => __( 'Heading', 'dw-store' ),
						'type'  => 'typography',
						'components' => array(
							'size'   => false
						),
						'value' => array(
							'family' => 'Roboto',
							'style'  => '500',
							'color'  => '#333'
						)
					),
					'link_color' => array(
						'label' => __( 'Link Color', 'dw-store' ),
						'type'  => 'color-picker',
						'value' => '#6ab344'
					),
					'link_hover_color' => array(
						'label' => __( 'Link Hover Color', 'dw-store' ),
						'type'  => 'color-picker',
						'value' => '#333333'
					),
					'custom_css' => array(
						'label' => __( 'Custom CSS', 'dw-store' ),
						'type'  => 'textarea',

						'desc' => __( 'Paste your CSS code, do not include any tags or HTML in thie field. Any custom CSS entered here will override the theme CSS. In some cases, the !important tag may be needed.', 'dw-store' ),
					),
					'posts_navigation' => array(
						'label' => 'Posts Navigation',
						'type'  => 'radio',

						'value' => 'paging',
								'choices' => array(
									'paging'  => __( 'Paging', 'unyson' ),
									'next_previous' => __( 'Next / Previous', 'unyson' ),
									'infinite_scroll' => __( 'Infinite Scroll', 'unyson' ),
								),
						'inline' => true
						)
				)
			)
		)
	)
);
