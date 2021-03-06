<?php

/**
 * Column shortcode.
 *
 * @since 1.0
 * @param array  $atts    The attributes array.
 * @param string $content The content.
 */
function fusion_builder_column( $atts, $content = '' ) {

	global $columns, $global_column_array;

	$content_id = get_the_id();
	if ( isset( $atts['widget_id'] ) ) {
		$content_id = $atts['widget_id'];
	}

	extract( shortcode_atts(
		array(
			'hide_on_mobile'      => fusion_builder_default_visibility( 'string' ),
			'class'               => '',
			'id'                  => '',
			'background_color'    => '',
			'background_image'    => '',
			'background_position' => 'left top',
			'background_repeat'   => 'no-repeat',
			'border_style'        => '',
			'border_size'         => '',
			'border_color'        => '',
			'border_position'     => 'all',
			'margin_top'          => ( class_exists( 'Avada' ) ) ? Avada()->settings->get( 'col_margin', 'top' ) : '',
			'margin_bottom'       => ( class_exists( 'Avada' ) ) ? Avada()->settings->get( 'col_margin', 'bottom' ) : '',
			'row_column_index'    => '',
			'spacing'             => '4%',
			'padding'             => '',
			'animation_type'      => '',
			'animation_direction' => 'left',
			'animation_speed'     => '0.3',
			'animation_offset'    => ( class_exists( 'Avada' ) ) ? Avada()->settings->get( 'animation_offset' ) : '',
			'center_content'      => 'no',
			'type'                => '1_3',
			'last'                => '',
			'link'                => '',
			'hover_type'          => 'none',
			'min_height'          => '',
		), $atts
	) );

	global $fusion_col_type;
	$fusion_col_type = array(
		'padding' => $padding,
		'type'    => $type,
	);

	if ( '' === $margin_bottom ) {
		$margin_bottom = FusionBuilder::get_theme_option( 'col_margin', 'bottom' );
	} else {
		$margin_bottom = FusionBuilder::get_value_with_unit( $margin_bottom );
	}
	if ( '' === $margin_top ) {
		$margin_top = FusionBuilder::get_theme_option( 'col_margin', 'top' );
	} else {
		$margin_top = FusionBuilder::get_value_with_unit( $margin_top );
	}

	if ( empty( $animation_offset ) ) {
		$animation_offset = FusionBuilder::get_theme_option( 'animation_offset' );
	}
	if ( $border_size ) {
		$border_size = FusionBuilder::validate_shortcode_attr_value( $border_size, 'px' );
	}

	// If there is no map of columns, we must use fallback method like 4.0.3.
	if ( ( ! isset( $global_column_array[ $content_id ] ) || ! array( $global_column_array[ $content_id ] ) || 0 === count( $global_column_array[ $content_id ] ) ) && 'no' !== $spacing ) {
		$spacing = 'yes';
	}

	// Columns. added last attribute.
	$style               = '';
	$classes             = '';
	$wrapper_classes     = 'fusion-column-wrapper';
	$wrapper_style       = '';
	$wrapper_style_bg    = '';
	$href_link           = '';
	$current_row         = '';
	$current_column_type = '';

	// Set the row and column index as well as the column type for the current column.
	if ( '' !== $row_column_index ) {
		$row_column_index = explode( '_', $row_column_index );
		$current_row_index = $row_column_index[0];
		$current_column_index = $row_column_index[1];
		$current_row = $global_column_array[ $content_id ][ $current_row_index ];

		if ( isset( $current_row ) && is_array( $current_row ) ) {
			$current_row_number_of_columns = count( $current_row );
			$current_column_type = $current_row[ $current_column_index ][1];
		}
	}

	// Column size value.
	switch ( $type ) {
		case '1_1' :
			$column_size = 1;
			$classes .= ' fusion-one-full';
			break;
		case '1_4' :
			$column_size = 0.25;
			$classes .= ' fusion-one-fourth';
			break;
		case '3_4' :
			$column_size = 0.75;
			$classes .= ' fusion-three-fourth';
			break;
		case '1_2' :
			$column_size = 0.50;
			$classes .= ' fusion-one-half';
			break;
		case '1_3' :
			$column_size = 0.3333;
			$classes .= ' fusion-one-third';
			break;
		case '2_3' :
			$column_size = 0.6666;
			$classes .= ' fusion-two-third';
			break;
		case '1_5' :
			$column_size = 0.20;
			$classes .= ' fusion-one-fifth';
			break;
		case '2_5' :
			$column_size = 0.40;
			$classes .= ' fusion-two-fifth';
			break;
		case '3_5' :
			$column_size = 0.60;
			$classes .= ' fusion-three-fifth';
			break;
		case '4_5' :
			$column_size = 0.80;
			$classes .= ' fusion-four-fifth';
			break;
		case '5_6' :
			$column_size = 0.8333;
			$classes .= ' fusion-five-sixth';
			break;
		case '1_6' :
			$column_size = 0.1666;
			$classes .= ' fusion-one-sixth';
			break;
	}

	// Map old column width to old width with spacing.
	$map_old_spacing = array(
		'0.1666' => '13.3333%',
		'0.8333' => '82.6666%',
		'0.2'    => '16.8%',
		'0.4'    => '37.6%',
		'0.6'    => '58.4%',
		'0.8'    => '79.2%',
		'0.25'   => '22%',
		'0.75'   => '74%',
		'0.3333' => '30.6666%',
		'0.6666' => '65.3333%',
		'0.5'    => '48%',
		'1'      => '100%',
	);

	$old_spacing_values = array(
		'yes',
		'Yes',
		'No',
		'no',
	);

	// Check if all columns are yes, no, or empty.
	$fallback = true;
	if ( is_array( $current_row ) && 0 !== count( $global_column_array[ $content_id ] ) ) {
		foreach ( $current_row as $column_space ) {
			if ( isset( $column_space[0] ) && ! in_array( $column_space[0], $old_spacing_values ) ) {
				$fallback = false;
			}
		}
	}

	// If not using a fallback, work out first and last from the generated array.
	if ( ! $fallback ) {
		if ( false !== strpos( $current_column_type, 'first' ) ) {
			$classes .= ' fusion-column-first';
		}

		if ( false !== strpos( $current_column_type, 'last' ) ) {
			$classes .= ' fusion-column-last';
			$last = 'yes';
		} else {
			$last = 'no';
		}

		// If we are using the fallback, then work out first and last using global var.
	} else {
		if ( ! $columns ) {
			$columns = 0;
		}
		if ( 'yes' !== $last ) {
			if ( 0 === $columns ) {
				$classes .= ' fusion-column-first';
			}
			$columns += $column_size;
			if ( 0.990 < $columns ) {
				$last = 'yes';
				$columns = 0;
			}
			if ( 1 < $columns ) {
				$last = 'no';
				$columns = $column_size;
				$classes .= ' fusion-column-first';
			}
		} else {
			$columns = 0;
		}
		if ( 'yes' === $last ) {
			$classes .= ' fusion-column-last';
		}
	}

	// Background.
	if ( ! empty( $background_color ) ) {
		if ( ( 'none' === $hover_type || empty( $hover_type ) ) ) {
			$wrapper_style .= 'background-color:' . esc_attr( $background_color ) . ';';
		} else {
			$wrapper_style_bg .= 'background-color:' . esc_attr( $background_color ) . ';';
		}
	}

	if ( ! empty( $background_image ) ) {
		$wrapper_style_bg .= "background-image: url('" . esc_attr( $background_image ) . "');"; }

	if ( ! empty( $background_position ) ) {
		$wrapper_style_bg .= 'background-position:' . esc_attr( $background_position ) . ';';
	}

	if ( ! empty( $background_repeat ) ) {
		$wrapper_style_bg .= 'background-repeat:' . esc_attr( $background_repeat ) . ';';
		if ( 'no-repeat' === $background_repeat ) {
			$wrapper_style_bg .= '-webkit-background-size:cover;-moz-background-size:cover;-o-background-size:cover;background-size:cover;';
		}
	}

	// Border.
	if ( $border_color && $border_size && $border_style ) {
		$border_position = ( 'all' !== $border_position ) ? '-' . $border_position : '';
		$wrapper_style .= 'border' . $border_position . ':' . $border_size . ' ' . $border_style . ' ' . $border_color . ';';
	}

	// Padding.
	if ( ! empty( $padding ) ) {
		$wrapper_style .= 'padding: ' . esc_attr( $padding ) . ';';
	}
	// Top margin.
	if ( '' !== $margin_top ) {
		$style .= 'margin-top:' . esc_attr( $margin_top ) . ';';
	}

	// Bottom margin.
	if ( '' !== $margin_bottom ) {
		$style .= 'margin-bottom:' . esc_attr( $margin_bottom ) . ';';
	}

	// Fix the spacing values.
	if ( is_array( $current_row ) ) {
		foreach ( $current_row as $key => $value ) {
			if ( '' === $value[0] || 'yes' === $value[0] ) {
				$current_row[ $key ] = '4%';
			} elseif ( 'no' === $value[0] ) {
				unset( $current_row[ $key ] );
			} else {
					$current_row[ $key ] = $value[0];
			}
		}
	}

	// Spacing.  If using fallback and spacing is no then ignore and just use full % width.
	if ( isset( $spacing ) && ! ( in_array( $spacing, array( '0px', 'no' ) ) && $fallback ) ) {
		$width = $column_size * 100 . '%';
		if ( 'yes' === $spacing || '' === $spacing ) {
			$spacing = '4%';
		} elseif ( 'no' === $spacing ) {
			$spacing = '0px';
		}
		$spacing = FusionBuilder::get_value_with_unit( esc_attr( $spacing ) );

		if ( '0' == filter_var( $spacing, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION ) ) {
			$classes .= ' fusion-spacing-no';
		}

		$width_offset = '';
		if ( is_array( $current_row ) ) {
			$width_offset = '( ( ' . implode( ' + ', $current_row ) . ' ) * ' . $column_size . ' ) ';
		}

		if ( 'yes' !== $last && ! ( $fallback && '0px' == $spacing ) ) {
			$spacing_direction = 'right';
			if ( is_rtl() ) {
				$spacing_direction = 'left';
			}
			if ( ! $fallback ) {
				$style .= 'width:' . $width . ';width:calc(' . $width . ' - ' . $width_offset . ');margin-' . $spacing_direction . ': ' . $spacing . ';';
			} else {
				$style .= 'width:' . $map_old_spacing[ strval( $column_size ) ] . '; margin-' . $spacing_direction . ': ' . $spacing . ';';
			}
		} elseif ( isset( $current_row_number_of_columns ) && 1 < $current_row_number_of_columns ) {
			if ( ! $fallback ) {
				$style .= 'width:' . $width . ';width:calc(' . $width . ' - ' . $width_offset . ');';
			} elseif ( '0px' != $spacing && isset( $map_old_spacing[ strval( $column_size ) ] ) ) {
				$style .= 'width:' . $map_old_spacing[ strval( $column_size ) ];
			} else {
				$style .= 'width:' . $width;
			}
		} elseif ( ! isset( $current_row_number_of_columns ) && isset( $map_old_spacing[ strval( $column_size ) ] ) ) {
			$style .= 'width:' . $map_old_spacing[ strval( $column_size ) ];
		}
	}

	// Custom CSS class.
	if ( ! empty( $class ) ) {
		$classes .= " {$class}";
	}

	// Visibility classes.
	$classes = fusion_builder_visibility_atts( $hide_on_mobile, $classes );

	// Hover type or link.
	if ( ! empty( $link ) || ( 'none' !== $hover_type && ! empty( $hover_type ) ) ) {
		$classes .= ' fusion-column-inner-bg-wrapper';
	}

	// Hover type or link.
	if ( ! empty( $link ) ) {
		$href_link .= 'href="' . $link . '"';
	}

	// Min height for newly created columns by the converter.
	if ( 'none' === $min_height ) {
		$classes .= ' fusion-column-no-min-height';
	}

	// Animation.
	$animation = fusion_builder_animation_data( $animation_type, $animation_direction, $animation_speed, $animation_offset );
	$wrapper_classes .= $animation['class'];

	// Style.
	$style = ! empty( $style ) ? " style='{$style}'" : '';

	// Wrapper Style.
	$wrapper_style = ! empty( $wrapper_style ) ? $wrapper_style : '';

	// Shortcode content.
	$inner_content = do_shortcode( fusion_builder_fix_shortcodes( $content ) );

	// If content should be centered, add needed markup.
	if ( 'yes' === $center_content ) {
		$inner_content = '<div class="fusion-column-table"><div class="fusion-column-tablecell">' . $inner_content . '</div></div>';
	}

	// Clearing div at end of inner content, as we did in old builder.
	$inner_content .= '<div class="fusion-clearfix"></div>';

	if ( ( 'none' === $hover_type && empty( $link ) ) || ( empty( $hover_type ) && empty( $link ) ) ) {

		$output =
		'<div ' . ( ! empty( $id ) ? 'id="' . esc_attr( $id ) . '"' : '' ) . ' class="fusion-layout-column fusion_builder_column fusion_builder_column_' . $type . ' ' . esc_attr( $classes ) . ' ' . ( ! empty( $type ) ? esc_attr( $type ) : '' ) . '" ' . $style . '>
			<div class="' . $wrapper_classes . '" ' . esc_attr( $animation['data'] ) . ' style="' . $wrapper_style . $wrapper_style_bg . '"  data-bg-url="' . $background_image . '">
				' . $inner_content . '
			</div>
		</div>';

	} else {

		$output =
		'<div ' . ( ! empty( $id ) ? 'id="' . esc_attr( $id ) . '"' : '' ) . ' class="fusion-layout-column fusion_builder_column fusion_builder_column_' . $type . ' ' . esc_attr( $classes ) . ' ' . ( ! empty( $type ) ? esc_attr( $type ) : '' ) . '" ' . $style . '>
			<div class="' . $wrapper_classes . '" ' . esc_attr( $animation['data'] ) . ' style="' . $wrapper_style . '" data-bg-url="' . $background_image . '">
				' . $inner_content . '
			</div>
			<span class="fusion-column-inner-bg hover-type-' . $hover_type . '">
				<a ' . $href_link . '>
					<span class="fusion-column-inner-bg-image" style="' . $wrapper_style_bg . '">
					</span>
				</a>
			</span>
		</div>';
	}

	return $output;
}
add_shortcode( 'fusion_builder_column', 'fusion_builder_column' );

/**
 * Map column shortcode to Fusion Builder.
 *
 * @since 1.0
 */
function fusion_element_column() {
	fusion_builder_map( array(
		'name'              => esc_attr__( 'Column', 'fusion-builder' ),
		'shortcode'         => 'fusion_builder_column',
		'hide_from_builder' => true,
		'params'            => array(
			array(
				'type'        => 'textfield',
				'heading'     => esc_attr__( 'Column Spacing', 'fusion-builder' ),
				'description' => esc_attr__( 'Controls the column spacing between one column to the next. Enter value including any valid CSS unit, ex: 4%.', 'fusion-builder' ),
				'param_name'  => 'spacing',
				'group'       => esc_attr__( 'General', 'fusion-builder' ),
				'value'       => '',
			),
			array(
				'type'        => 'radio_button_set',
				'heading'     => esc_attr__( 'Center Content', 'fusion-builder' ),
				'description' => esc_attr__( 'This option only works for columns inside a container that is set to equal heights. Set to "Yes" to center the content horizontally and vertically.', 'fusion-builder' ),
				'param_name'  => 'center_content',
				'default'     => 'no',
				'group'       => esc_attr__( 'General', 'fusion-builder' ),
				'value'       => array(
					esc_attr__( 'Yes', 'fusion-builder' ) => 'yes',
					esc_attr__( 'No', 'fusion-builder' )  => 'no',
				),
			),
			array(
				'type'        => 'radio_button_set',
				'heading'     => esc_attr__( 'Hover Type', 'fusion-builder' ),
				'description' => esc_attr__( 'Select the hover effect type.', 'fusion-builder' ),
				'param_name'  => 'hover_type',
				'default'     => 'none',
				'value'       => array(
					esc_attr__( 'None', 'fusion-builder' )     => 'none',
					esc_attr__( 'Zoom In', 'fusion-builder' )  => 'zoomin',
					esc_attr__( 'Zoom Out', 'fusion-builder' ) => 'zoomout',
					esc_attr__( 'Lift Up', 'fusion-builder' )  => 'liftup',
				),
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_attr__( 'Link URL', 'fusion-builder' ),
				'description' => esc_attr__( 'Add the URL the column will link to, ex: http://example.com.', 'fusion-builder' ),
				'param_name'  => 'link',
				'value'       => '',
			),
			array(
				'type'        => 'radio_button_set',
				'heading'     => esc_attr__( 'Ignore Equal Heights', 'fusion-builder' ),
				'description' => esc_attr__( 'Choose to ignore equal heights on this column if you are using equal heights on the surrounding container.', 'fusion-builder' ),
				'param_name'  => 'min_height',
				'default'     => '',
				'group'       => esc_attr__( 'General', 'fusion-builder' ),
				'value'       => array(
					esc_attr__( 'Yes', 'fusion-builder' ) => 'none',
					esc_attr__( 'No', 'fusion-builder' )  => '',
				),
			),
			array(
				'type'        => 'checkbox_button_set',
				'heading'     => esc_attr__( 'Column Visibility', 'fusion-builder' ),
				'param_name'  => 'hide_on_mobile',
				'value'       => fusion_builder_visibility_options( 'full' ),
				'default'     => fusion_builder_default_visibility( 'array' ),
				'description' => esc_attr__( 'Choose to show or hide the column on small, medium or large screens. You can choose more than one at a time.', 'fusion-builder' ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_attr__( 'CSS Class', 'fusion-builder' ),
				'description' => esc_attr__( 'Add a class to the wrapping HTML element.', 'fusion-builder' ),
				'param_name'  => 'class',
				'value'       => '',
				'group'       => esc_attr__( 'General', 'fusion-builder' ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_attr__( 'CSS ID', 'fusion-builder' ),
				'description' => esc_attr__( 'Add an ID to the wrapping HTML element.', 'fusion-builder' ),
				'param_name'  => 'id',
				'value'       => '',
				'group'       => esc_attr__( 'General', 'fusion-builder' ),
			),
			array(
				'type'        => 'colorpickeralpha',
				'heading'     => esc_attr__( 'Background Color', 'fusion-builder' ),
				'description' => esc_attr__( 'Controls the background color.', 'fusion-builder' ),
				'param_name'  => 'background_color',
				'value'       => '',
				'group'       => esc_attr__( 'Design', 'fusion-builder' ),
			),
			array(
				'type'        => 'upload',
				'heading'     => esc_attr__( 'Background Image', 'fusion-builder' ),
				'description' => esc_attr__( 'Upload an image to display in the background.', 'fusion-builder' ),
				'param_name'  => 'background_image',
				'value'       => '',
				'group'       => esc_attr__( 'Design', 'fusion-builder' ),
			),
			array(
				'type'        => 'select',
				'heading'     => esc_attr__( 'Background Position', 'fusion-builder' ),
				'description' => esc_attr__( 'Choose the postion of the background image.', 'fusion-builder' ),
				'param_name'  => 'background_position',
				'default'     => 'left top',
				'group'       => esc_attr__( 'Design', 'fusion-builder' ),
				'dependency'  => array(
					array(
						'element'  => 'background_image',
						'value'    => '',
						'operator' => '!=',
					),
				),
				'value'       => array(
					esc_attr__( 'Left Top', 'fusion-builder' )      => 'left top',
					esc_attr__( 'Left Center', 'fusion-builder' )   => 'left center',
					esc_attr__( 'Left Bottom', 'fusion-builder' )   => 'left bottom',
					esc_attr__( 'Right Top', 'fusion-builder' )     => 'right top',
					esc_attr__( 'Right Center', 'fusion-builder' )  => 'right center',
					esc_attr__( 'Right Bottom', 'fusion-builder' )  => 'right bottom',
					esc_attr__( 'Center Top', 'fusion-builder' )    => 'center top',
					esc_attr__( 'Center Center', 'fusion-builder' ) => 'center center',
					esc_attr__( 'Center Bottom', 'fusion-builder' ) => 'center bottom',
				),
			),
			array(
				'type'        => 'select',
				'heading'     => esc_attr__( 'Background Repeat', 'fusion-builder' ),
				'description' => esc_attr__( 'Choose how the background image repeats.', 'fusion-builder' ),
				'param_name'  => 'background_repeat',
				'default'     => 'no-repeat',
				'group'       => esc_attr__( 'Design', 'fusion-builder' ),
				'dependency'  => array(
					array(
						'element'  => 'background_image',
						'value'    => '',
						'operator' => '!=',
					),
				),
				'value'       => array(
					esc_attr__( 'No Repeat', 'fusion-builder' )                          => 'no-repeat',
					esc_attr__( 'Repeat Vertically and Horizontally', 'fusion-builder' ) => 'repeat',
					esc_attr__( 'Repeat Horizontally', 'fusion-builder' )                => 'repeat-x',
					esc_attr__( 'Repeat Vertically', 'fusion-builder' )                  => 'repeat-y',
				),
			),
			array(
				'type'        => 'range',
				'heading'     => esc_attr__( 'Border Size', 'fusion-builder' ),
				'description' => esc_attr__( 'Controls the border size of the column. In pixels.', 'fusion-builder' ),
				'param_name'  => 'border_size',
				'value'       => '0',
				'min'         => '0',
				'max'         => '50',
				'step'        => '1',
				'group'       => esc_attr__( 'Design', 'fusion-builder' ),
			),
			array(
				'type'        => 'colorpicker',
				'heading'     => esc_attr__( 'Border Color', 'fusion-builder' ),
				'description' => esc_attr__( 'Controls the border color.', 'fusion-builder' ),
				'param_name'  => 'border_color',
				'value'       => '',
				'group'       => esc_attr__( 'Design', 'fusion-builder' ),
				'dependency'  => array(
					array(
						'element'  => 'border_size',
						'value'    => '0',
						'operator' => '!=',
					),
				),
			),
			array(
				'type'        => 'radio_button_set',
				'heading'     => esc_attr__( 'Border Style', 'fusion-builder' ),
				'description' => esc_attr__( 'Controls the border style.', 'fusion-builder' ),
				'param_name'  => 'border_style',
				'default'     => 'solid',
				'group'       => esc_attr__( 'Design', 'fusion-builder' ),
				'dependency'  => array(
					array(
						'element'  => 'border_size',
						'value'    => '0',
						'operator' => '!=',
					),
				),
				'value'       => array(
					esc_attr__( 'Solid', 'fusion-builder' )  => 'solid',
					esc_attr__( 'Dashed', 'fusion-builder' ) => 'dashed',
					esc_attr__( 'Dotted', 'fusion-builder' ) => 'dotted',
				),
			),
			array(
				'type'        => 'radio_button_set',
				'heading'     => esc_attr__( 'Border Position', 'fusion-builder' ),
				'description' => esc_attr__( 'Choose the postion of the border.', 'fusion-builder' ),
				'param_name'  => 'border_position',
				'default'     => 'all',
				'group'       => esc_attr__( 'Design', 'fusion-builder' ),
				'dependency'  => array(
					array(
						'element'  => 'border_size',
						'value'    => '0',
						'operator' => '!=',
					),
				),
				'value'       => array(
					esc_attr__( 'All', 'fusion-builder' )    => 'all',
					esc_attr__( 'Top', 'fusion-builder' )    => 'top',
					esc_attr__( 'Right', 'fusion-builder' )  => 'right',
					esc_attr__( 'Bottom', 'fusion-builder' ) => 'bottom',
					esc_attr__( 'Left', 'fusion-builder' )   => 'left',
				),
			),
			array(
				'type'        => 'dimension',
				'heading'     => esc_attr__( 'Padding', 'fusion-builder' ),
				'description' => esc_attr__( 'In pixels (px), ex: 10px.', 'fusion-builder' ),
				'param_name'  => 'padding',
				'value'       => '',
				'group'       => esc_attr__( 'Design', 'fusion-builder' ),
			),
			array(
				'type'             => 'dimension',
				'remove_from_atts' => true,
				'heading'          => esc_attr__( 'Margin', 'fusion-builder' ),
				'description'      => esc_attr__( 'In pixels (px), ex: 10px.', 'fusion-builder' ),
				'param_name'       => 'dimension_margin',
				'value'            => array(
					'margin_top'    => '',
					'margin_bottom' => '',
				),
				'group'            => esc_attr__( 'Design', 'fusion-builder' ),
			),
			array(
				'type'        => 'select',
				'heading'     => esc_attr__( 'Animation Type', 'fusion-builder' ),
				'description' => esc_attr__( 'Select the type of animation to use on the element.', 'fusion-builder' ),
				'param_name'  => 'animation_type',
				'value'       => fusion_builder_available_animations(),
				'default'     => '',
				'group'       => esc_attr__( 'Animation', 'fusion-builder' ),
			),
			array(
				'type'        => 'radio_button_set',
				'heading'     => esc_attr__( 'Direction of Animation', 'fusion-builder' ),
				'description' => esc_attr__( 'Select the incoming direction for the animation.', 'fusion-builder' ),
				'param_name'  => 'animation_direction',
				'value'       => array(
					esc_attr__( 'Top', 'fusion-builder' )    => 'down',
					esc_attr__( 'Right', 'fusion-builder' )  => 'right',
					esc_attr__( 'Bottom', 'fusion-builder' ) => 'up',
					esc_attr__( 'Left', 'fusion-builder' )   => 'left',
					esc_attr__( 'Static', 'fusion-builder' ) => 'static',
				),
				'default'     => 'left',
				'group'       => esc_attr__( 'Animation', 'fusion-builder' ),
				'dependency'  => array(
					array(
						'element'  => 'animation_type',
						'value'    => '',
						'operator' => '!=',
					),
				),
			),
			array(
				'type'        => 'range',
				'heading'     => esc_attr__( 'Speed of Animation', 'fusion-builder' ),
				'description' => esc_attr__( 'Type in speed of animation in seconds (0.1 - 1).', 'fusion-builder' ),
				'param_name'  => 'animation_speed',
				'min'         => '0.1',
				'max'         => '1',
				'step'        => '0.1',
				'value'       => '0.3',
				'group'       => esc_attr__( 'Animation', 'fusion-builder' ),
				'dependency'  => array(
					array(
						'element'  => 'animation_type',
						'value'    => '',
						'operator' => '!=',
					),
				),
			),
			array(
				'type'        => 'select',
				'heading'     => esc_attr__( 'Offset of Animation', 'fusion-builder' ),
				'description' => esc_attr__( 'Controls when the animation should start.', 'fusion-builder' ),
				'param_name'  => 'animation_offset',
				'default'     => '',
				'group'       => esc_attr__( 'Animation', 'fusion-builder' ),
				'dependency'  => array(
					array(
						'element'  => 'animation_type',
						'value'    => '',
						'operator' => '!=',
					),
				),
				'value'       => array(
					esc_attr__( 'Default', 'fusion-builder' )                                => '',
					esc_attr__( 'Top of element hits bottom of viewport', 'fusion-builder' ) => 'top-into-view',
					esc_attr__( 'Top of element hits middle of viewport', 'fusion-builder' ) => 'top-mid-of-view',
					esc_attr__( 'Bottom of element enters viewport', 'fusion-builder' )      => 'bottom-in-view',
				),
			),
		),
	) );
}
add_action( 'fusion_builder_before_init', 'fusion_element_column' );
