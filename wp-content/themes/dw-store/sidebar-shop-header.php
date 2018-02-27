<?php
$image = false;
if ( is_product_category() ) {
	global $wp_query;
	$cat = $wp_query->get_queried_object();
	$thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
	$image = wp_get_attachment_url( $thumbnail_id );
}
?>
<?php if ( $image ) : ?>
	<div class="shop-header">
		<img src="<?php echo $image; ?>" alt="" />
	</div>
<?php elseif ( is_product_category() || is_active_sidebar( 'shop-header' ) ) : ?>
	<div class="shop-header">
		<?php dynamic_sidebar( 'shop-header' ); ?>
	</div>
<?php endif; ?>
