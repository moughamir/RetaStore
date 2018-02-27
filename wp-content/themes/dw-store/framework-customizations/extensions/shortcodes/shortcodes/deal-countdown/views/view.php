<?php if (!defined('FW')) die('Forbidden'); ?>
<?php
$numbers = isset( $atts['numbers'] ) ? $atts['numbers'] : 6;
$col_num = isset( $atts['col_num'] ) ? $atts['col_num'] : 3;
$title = isset( $atts['title'] ) ? $atts['title'] : '';
$custom_query_args = array(
	'post_type' => 'product',
	'meta_query'     => array(
		'relation' => 'OR',
		array(
			'key'           => '_sale_price',
			'value'         => 0,
			'compare'       => '>',
			'type'          => 'numeric'
			),
		array(
			'key'           => '_min_variation_sale_price',
			'value'         => 0,
			'compare'       => '>',
			'type'          => 'numeric'
			)
		)
	);
$custom_query = new WP_Query( $custom_query_args );
?>
<div class="woocommerce countdown">

	<?php
	if ( $custom_query->have_posts() ) :
		$col = 12 / $col_num;
	$classes = 'col-sm-6 col-md-' .$col;
	$i = 1;
	$ii = 0;
	$item_count = $custom_query->post_count;
	?>
	<h3><?php echo $title; ?></h3>
	<div class="products-grid">
		<div class="row">
			<?php
			while ( $custom_query->have_posts() ) : $custom_query->the_post();
			$sale_price_dates 	= get_post_meta( get_the_ID(), '_sale_price_dates_to', true );?>
										<?php if ( $sale_price_dates ) {
											$ii++;
			do_action( 'woocommerce_before_shop_loop_item' );
			?>

			<div class="<?php echo esc_attr( $classes ); ?>">
				<div <?php post_class(); ?>>
					<a href="<?php the_permalink(); ?>">

						<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>

						<div class="product-info">

							<h3 class="product-title"><?php the_title(); ?></h3>

							<?php
							do_action( 'woocommerce_after_shop_loop_item_title' );
							?>

							<?php $sale_price_dates_to = date( 'Y-m-d', $sale_price_dates ); ?>
							<span id="countdown-<?php echo get_the_ID(); ?>"></span>
							<script>
							var id = <?php echo get_the_ID(); ?>;
							var sale_to = '<?php echo $sale_price_dates_to; ?>';
							var to  = sale_to.split("-");
							to = new Date(to[0], to[1] - 1, to[2]);
							jQuery('#countdown-'+id).countdown({until: to});
							</script>

					</div>

				</a>
			</div>

		</div>
		<?php }  ?>
		<?php if ( ( 0 === $i % ( $col_num ) ) && ( $i < $item_count ) ) : ?>
	</div><div class="row">
<?php endif; ?>
<?php if ( $numbers == $ii ) {
	break;
}?>
<?php $i++ ; ?>
<?php endwhile; ?>
</div>
</div>
<?php else : ?>
	<?php get_template_part( 'content', 'none' ); ?>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
</div>
