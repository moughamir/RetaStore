<?php if (!defined('FW')) die('Forbidden'); ?>
<?php
$numbers = isset( $atts['numbers'] ) ? $atts['numbers'] : 6;
$col_num = isset( $atts['col_num'] ) ? $atts['col_num'] : 3;
$cat_id = isset( $atts['cat_id'] ) ? $atts['cat_id'] : '';
$tag_id = isset( $atts['tag_id'] ) ? $atts['tag_id'] :'';


$custom_query_args = array(
	'post_type' => 'product',
	'posts_per_page' => intval( $atts['numbers'] )
	);

if ( $tag_id && $cat_id ) {
	$custom_query_args['tax_query'] = array(
		'relation' => 'AND',
		array(
			'taxonomy' => 'product_cat',
			'field' => 'id',
			'terms' => $cat_id,
			),
		array(
			'taxonomy' => 'product_tag',
			'field' => 'id',
			'terms' => $tag_id,
			),
		);
} else {
	if ( $tag_id ) {
		$custom_query_args['tax_query'] = array(
			array(
				'taxonomy' => 'product_tag',
				'field' => 'id',
				'terms' => $tag_id,
				)
			);
	}

	if ( $cat_id ) {
		$custom_query_args['product_cat'] = array(
			array(
				'taxonomy' => 'product_cat',
				'field' => 'id',
				'terms' => $cat_id,
				)
			);
	}
}

$custom_query = new WP_Query( $custom_query_args ); ?>
<div class="woocommerce columns-<?php echo $col_num ; ?>">
	<?php if ( $custom_query->have_posts() ) : ?>
	<ul class="products">
		<?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
		<?php wc_get_template_part( 'content', 'product' ); ?>
	<?php endwhile; ?>
</ul>
<?php else : ?>
	<?php get_template_part( 'content', 'none' ); ?>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
</div>
