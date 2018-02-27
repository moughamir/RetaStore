<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$bg_color = '';
if ( ! empty( $atts['background_color'] ) ) {
	$bg_color = 'background-color:' . $atts['background_color'] . ';';
}

$bg_image = '';
if ( ! empty( $atts['background_image'] ) && ! empty( $atts['background_image']['data']['icon'] ) ) {
	$bg_image = 'background-image:url(' . $atts['background_image']['data']['icon'] . ');';
}

$bg_video_data_attr    = '';
$section_extra_classes = '';
if ( ! empty( $atts['video'] ) ) {
	$filetype           = wp_check_filetype( $atts['video'] );
	$filetypes          = array( 'mp4' => 'mp4', 'ogv' => 'ogg', 'webm' => 'webm', 'jpg' => 'poster' );
	$filetype           = array_key_exists( (string) $filetype['ext'], $filetypes ) ? $filetypes[ $filetype['ext'] ] : 'video';
	$bg_video_data_attr = 'data-wallpaper-options="' . fw_htmlspecialchars( json_encode( array( 'source' => array( $filetype => $atts['video'] ) ) ) ) . '"';
	$section_extra_classes .= ' background-video';
}

$section_style = 'style="';
if ( $bg_color || $bg_image ) {
	$section_style .= $bg_color . $bg_image;
};
if ( ! empty( $atts['background_position'] ) && ! empty( $atts['background_position'] ) ) {
	$section_style .= 'background-position:' . $atts['background_position'] . ';';
}
if ( ! empty( $atts['background_size'] ) && ! empty( $atts['background_size'] ) ) {
	$section_style .= 'background-size:' . $atts['background_size'] . ';';
}
if ( isset( $atts['padding'] ) && $atts['padding'] ) {
	$section_style .= 'padding: '. $atts['padding'] . ';';
};
if ( isset( $atts['margin'] ) && $atts['margin'] ) {
	$section_style .= 'margin: '. $atts['margin'] . ';';
};
$section_style .= '"';

$container_class = ( isset( $atts['is_fullwidth'] ) && $atts['is_fullwidth'] ) ? 'fw-container-fluid' : 'fw-container';

if ( isset( $atts['remove_columns_gutter'] ) && $atts['remove_columns_gutter'] ) {
	$section_extra_classes .= ' remove-columns-gutter';
}

if ( isset( $atts['class'] ) && $atts['class'] ) {
	$section_extra_classes .= ' ' . $atts['class'];
}
?>
<section class="fw-main-row <?php echo $section_extra_classes ?>" <?php echo $section_style; ?> <?php echo $bg_video_data_attr; ?>>
	<div class="<?php echo $container_class; ?>">
		<?php echo do_shortcode( $content ); ?>
	</div>
</section>
