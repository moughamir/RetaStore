<?php if (!defined('FW')) die( 'Forbidden' );
$section_style = 'style="';
if ( ! empty( $atts['heading_color'] ) ) {
	$section_style .=  'color:' . $atts['heading_color'] . ';';
}
$section_style .= '"';
?>
<div class="fw-heading fw-heading-<?php echo $atts['heading']; ?> <?php echo !empty($atts['centered']) ? 'fw-heading-center' : ''; ?>" <?php echo $section_style; ?>>
	<?php $heading = "<{$atts['heading']} class='fw-special-title'>{$atts['title']}</{$atts['heading']}>"; ?>
	<?php echo $heading; ?>
	<?php if (!empty($atts['subtitle'])): ?>
		<div class="fw-special-subtitle"><?php echo $atts['subtitle']; ?></div>
	<?php endif; ?>
</div>
