<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
/**
 * @var array $atts
 */
?>
<?php
/*
 * `.fw-iconbox` supports 3 styles:
 * `fw-iconbox-1`, `fw-iconbox-2` and `fw-iconbox-3`
 */
$background_style = '';
if ( isset( $atts['background_color'] ) && $atts['background_color'] ) {
	$background_style .= 'background-color: '. $atts['background_color'] . ';';
}

if ( isset( $atts['padding'] ) && $atts['padding'] ) {
	$background_style .= 'padding: '. $atts['padding'] . ';';
}

if ( isset( $atts['icon_color'] ) && $atts['icon_color'] ) {
	$icon_style = 'color: '. $atts['icon_color'] . ';';
}

if ( isset( $atts['title_color'] ) && $atts['title_color'] ) {
	$title_style = 'color: '. $atts['title_color'] . ';';
}

if ( isset( $atts['content_color'] ) && $atts['content_color'] ) {
	$content_style = 'color: '. $atts['content_color'] . ';';
}


?>
<div class="fw-iconbox clearfix <?php echo $atts['style']; ?>" style="<?php echo $background_style; ?>">
	<div class="fw-iconbox-image">
		<i style="<?php echo $icon_style; ?>" class="<?php echo $atts['icon']; ?>"></i>
	</div>
	<div class="fw-iconbox-aside">
		<div class="fw-iconbox-title">
			<h3 style="<?php echo $title_style; ?>"><?php echo $atts['title']; ?></h3>
		</div>
		<div class="fw-iconbox-text">
			<p style="<?php echo $content_style; ?>"><?php echo $atts['content']; ?></p>
		</div>
	</div>
</div>
