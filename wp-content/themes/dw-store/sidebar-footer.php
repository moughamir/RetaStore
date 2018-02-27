<?php
if ( ! is_active_sidebar( 'footer-1' )
	&& ! is_active_sidebar( 'footer-2' )
	&& ! is_active_sidebar( 'footer-3' )
	&& ! is_active_sidebar( 'footer-4' ) ) {
	return;
}
?>

<div id="footer-widgets" class="widget-area" role="complementary">
	<div class="row">
		<div class="col-md-2"><?php dynamic_sidebar( 'footer-1' ); ?></div>
		<div class="col-md-2"><?php dynamic_sidebar( 'footer-2' ); ?></div>
		<div class="col-md-2"><?php dynamic_sidebar( 'footer-3' ); ?></div>
		<div class="col-md-4 col-md-offset-2"><?php dynamic_sidebar( 'footer-4' ); ?></div>
	</div>
</div>
