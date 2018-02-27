<?php if (!defined('FW')) die( 'Forbidden' ); ?>
<?php
$btn_class = '';
if ( ! empty( $atts['style'] ) && ! empty( $atts['style'] ) ) {
	$btn_class .= ' ' . $atts['style'];
}
if ( ! empty( $atts['size'] ) && ! empty( $atts['size'] ) ) {
	$btn_class .= ' ' . $atts['size'];
}
if ( isset( $atts['is_fullwidth'] ) && $atts['is_fullwidth'] ) {
	$btn_class .= ' btn-block';
}


?>
<a href="<?php echo $atts['link'] ?>" target="<?php echo $atts['target'] ?>" class="btn<?php echo $btn_class; ?>">
	<span><?php echo $atts['label']; ?></span>
</a>
